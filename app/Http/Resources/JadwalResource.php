<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'hari' => $this->hari,
            'kelas' => $this->kelas->kd_kelas,
            'dosen' => $this->dosen->nama,
            'matkul' => $this->matkul->nm_matkul,
            'sks' => $this->matkul->sks,
            'jam_masuk' => $this->jam_masuk,
            'jam_keluar' => $this->jam_keluar,
        ];
    }
}
