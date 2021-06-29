<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Dosen extends Authenticatable
{
    use HasFactory, HasRoles;

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function matkuls()
    {
        return $this->belongsToMany(Matkul::class);
    }
}
