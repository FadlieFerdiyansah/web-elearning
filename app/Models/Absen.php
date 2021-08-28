<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = ['mahasiswa_id','jadwal_id','status','pertemuan'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
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
