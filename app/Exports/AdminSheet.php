<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminSheet implements WithHeadings, WithTitle
{
    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Email',
            'Role',
            'Mobile Number',
            'Employee Code',
            'Security Code',
        ];
    }

    public function title(): string
    {
        return 'Admin Upload Sheet';
    }

    public function array(): array
    {
        return []; // Empty rows
    }
}
