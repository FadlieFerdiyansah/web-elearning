<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kd_kelas'];
    public $timestamps = false;
    // protected $with = ['jadwals'];

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

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
    
}
