<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Student Upload Sheet'    => new StudentsSheet(),      // MAIN
            'Departments' => new DepartmentsSheet(),   // REFERENCE
            'Programmes'  => new ProgrammesSheet(),    // REFERENCE
            'Gender'      => new GenderSheet(),
        ];
    }
}
