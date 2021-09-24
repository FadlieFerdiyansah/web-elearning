<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [ 'dosen_id', 'mahasiswa_id', 'parent', 'status', 'pertemuan', 'rangkuman', 'berita_acara', ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    // public function getStatusAttribute($value)
    // {
    //     return $value == 1 ? 'Hadir' : 'Tidak Hadir';
    // }

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
}
