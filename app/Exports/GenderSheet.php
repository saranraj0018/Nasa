<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenderSheet implements FromArray, WithHeadings,WithTitle
{
    public function headings(): array
    {
        return ['code', 'description'];
    }

    public function title(): string
    {
        return 'Gender';
    }

    public function array(): array
    {
        return [
            ['m', 'Male'],
            ['f', 'Female'],
            ['o', 'Others'],
        ];
    }

}
