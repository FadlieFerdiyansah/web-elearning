<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = ['kd_matkul','nm_matkul','sks'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class);
    }

    //Mutators when attribute 'nameOfAttribute' store will be lowercase
    public function setNmMatkulAttribute($value)
    {
        return $this->attributes['nm_matkul'] = strtolower($value);
    }

    public function getNmMatkulAttribute()
    {
        return strtoupper($this->attributes['nm_matkul']);
    }
}
