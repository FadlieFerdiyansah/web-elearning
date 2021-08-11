<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;
    // protected $with = ['kelas','matkul'];
    protected $fillable = ['judul','pertemuan','tipe','file_or_link','deskripsi','kelas_id','dosen_id','matkul_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');

    }
}
