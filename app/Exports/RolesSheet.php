<?php

namespace App\Exports;

use App\Models\Role;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Role::select('id', 'name')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Role Name'];
    }

    public function title(): string
    {
        return 'Roles';
    }
}
