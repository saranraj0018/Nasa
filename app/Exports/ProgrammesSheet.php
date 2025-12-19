<?php

namespace App\Exports;

use App\Models\Programme;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgrammesSheet implements FromCollection, WithHeadings,WithTitle
{
    public function collection()
    {
        return Programme::select('id', 'name')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Programme Name'];
    }

    public function title(): string
    {
        return 'Programmes';
    }

}
