<?php

namespace App\Models;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = ['kd_matkul','nm_matkul','sks'];
    // protected $with = ['materis'];
    
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function setNmMatkulAttribute($value)
    {
        return $this->attributes['nm_matkul'] = strtolower($value);
    }

    public function getNmMatkulAttribute()
    {
        return strtoupper($this->attributes['nm_matkul']);
    }

    public function getKdMatkulAttribute()
    {
        return strtoupper($this->attributes['kd_matkul']);
    }
}
