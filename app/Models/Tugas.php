<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [ 'jadwal_id', 'parent', 'judul', 'tipe', 'file_or_link', 'pertemuan', 'deskripsi', 'pengumpulan' ];
    // protected $with = ['mahasiswa'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Jadwal::class, 'id', 'id', 'jadwal_id', 'kelas_id');
    }
}
