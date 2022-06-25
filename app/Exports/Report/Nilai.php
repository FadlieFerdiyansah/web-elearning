<?php

namespace App\Exports\Report;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Nilai implements FromCollection, WithHeadings
{
    protected $mahasiswa;
    public function __construct($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }


    public function headings(): array
    {
        return [
            'Kelas',
            'NIM',
            'Nama',
            'Mata Kuliah',
            'P 1',
            'P 2',
            'P 3',
            'P 4',
            'P 5',
            'P 6',
            'P 7',
            'P 8',
            'P 9',
            'P 10',
            'P 11',
            'P 12',
            'P 13',
            'P 14',
            'P 15',
            'P 16',
        ];
    }

    public function collection()
    {
        return $this->mahasiswa;
    }
}
