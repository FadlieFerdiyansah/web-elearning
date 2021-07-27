<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kd_kelas'];
    public $timestamps = false;

    // public function matkul()
    // {
    //     return $this->hasManyThrough(Matkul::class,Jadwal::class);
    // }

    //  public function getRouteKeyName()
    //  {
    //      return 'kd_kelas';
    //  }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
    
    public function dosens()
    {
        return $this->belongsToMany(Dosen::class);
    }

    // public function mahasiswa()
    // {
    //     return $this->hasMany(Mahasiswa::class);
    // }
}
