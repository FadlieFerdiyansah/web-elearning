<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{

    use HasFactory, HasRoles, Notifiable;
    
    protected $fillable = ['foto','nim','nama','email','password','fakultas_id','kelas_id'];
    // protected $with = ['absens','userAbsen'];

    public function getPictureAttribute()
    {
        return asset('/storage/'.$this->foto);
    }

    public function getPictureDefaultAttribute()
    {
        return asset('/assets/images/default.png');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function mahasiswaAbsenHariIni()
    {
            return $this->hasOne(Absen::class)
            ->whereNotNull('mahasiswa_id')
            ->where('parent','!=', 0)
            ->where('status', 1)
            ->whereDate('created_at', date('Y-m-d'));
    }

    public function isAbsen($jadwalId)
    {
            return $this->absens()->whereNotNull('mahasiswa_id')
            ->where('parent','!=', 0)
            ->where('status', 1)
            ->where('jadwal_id', $jadwalId)
            ->whereDate('created_at', date('Y-m-d'));
    }

    // public function scopeCountAbsensiMahasiswa($query, $operator)
    // {
    //     return $query->where('mahasiswaAbsenHariIni', '!=', null);
    // }

    // public function mahasiswaAbsenPerJadwal()
    // {
    //     return $this->hasMany(Absen::class)
    //             ->whereNotNull('mahasiswa_id')
    //             ->where('parent','!=', 0)
    //             ->where('status', 1)
    //             ->whereDate('created_at', date('Y-m-d'));
    // }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    public function nilais()
    {
        return $this->hasManyThrough(Nilai::class, Tugas::class);
    }


}
