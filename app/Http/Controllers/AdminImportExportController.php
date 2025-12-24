<?php

namespace App\Http\Controllers;

use App\Exports\AdminTemplateExport;
use App\Imports\AdminImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class AdminImportExportController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new AdminTemplateExport, 'admin_upload_template.xlsx');
    }

    public function uploadAdmin(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx'
            ]);
            $import = new AdminImport();
            try {
                Excel::import($import, $request->file('file'));
            } catch (ValidationException $e) {
                $failures = $e->failures();
                return back()->with('failures', $failures);
            }
            // // If you used SkipsOnFailure in your Import class and didn't catch the exception
            if ($import->failures()->isNotEmpty()) {
                $failures = $import->failures();
                return back()->with('failures', $failures);
            }
            return back()->with('success', 'Students Uploaded Successfully');
        } catch (ValidationException $e) {
        }
    }
}
