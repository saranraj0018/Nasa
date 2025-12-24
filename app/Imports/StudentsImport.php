<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements WithMultipleSheets
{

    public StudentsImportSheet $sheet;

    public function __construct()
    {
        $this->sheet = new StudentsImportSheet();
    }

    public function sheets(): array
    {
        return [
            'Student Upload Sheet' => $this->sheet,
        ];
    }

    public function failures()
    {
        return $this->sheet->failures();
    }
}
