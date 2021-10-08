<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [ 'dosen_id', 'mahasiswa_id', 'parent', 'status', 'pertemuan', 'rangkuman', 'berita_acara', 'jadwal_id'];
    // protected $with = ['dosen'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // public function getStatusAttribute($value)
    // {
    //     return $value == 1 ? 'Hadir' : 'Tidak Hadir';
    // }

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($this->attributes['created_at'])->translatedFormat('Y-m-d');
    // }

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
}
