<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdminTemplateExport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Admin Upload Sheet'    => new AdminSheet(),      // MAIN
            'Roles' => new RolesSheet(),   // REFERENCE
        ];
    }
}
