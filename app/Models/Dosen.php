<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $guarded = [];
    protected $with = ['kelas'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function matkuls()
    {
        return $this->belongsToMany(Matkul::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
}
