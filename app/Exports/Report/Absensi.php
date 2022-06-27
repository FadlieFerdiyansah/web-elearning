<?php

namespace App\Exports\Report;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\{WithStyles, WithHeadings, FromCollection, WithColumnWidths};

class Absensi implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
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

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,            
            'C' => 30,            
            'D' => 30,
            'E' => 5,
            'F' => 5,
            'G' => 5,
            'H' => 5,
            'I' => 5,
            'J' => 5,
            'K' => 5,
            'L' => 5,
            'M' => 5,
            'N' => 5,
            'O' => 5,
            'P' => 5,
            'Q' => 5,
            'R' => 5,
            'S' => 5,
            'T' => 5,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:Z1' => ['alignment' => ['horizontal' => 'center']],
            '2:50' => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function collection()
    {
        return $this->mahasiswa;
    }
}
