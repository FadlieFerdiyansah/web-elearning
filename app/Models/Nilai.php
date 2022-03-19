<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $fillable = [ 'tugas_id', 'komentar_dosen', 'nilai' ];

    protected $table = 'nilai_tugas';
}
