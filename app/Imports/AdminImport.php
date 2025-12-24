<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;

class AdminImport implements WithMultipleSheets
{

    public AdminsImportSheet $sheet;

    public function __construct()
    {
        $this->sheet = new AdminsImportSheet();
    }

    public function sheets(): array
    {
        return [
            'Admin Upload Sheet' => $this->sheet,
        ];
    }

    public function failures()
    {
        return $this->sheet->failures();
    }
}
