<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DepartmentsSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Department::select('id', 'name')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Department Name'];
    }

    public function title(): string
    {
        return 'Departments';
    }
}
