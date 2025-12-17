<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new StudentsSheet(),
            new DepartmentsSheet(),
            new ProgrammesSheet(),
            new GenderSheet(),
        ];
    }
}
