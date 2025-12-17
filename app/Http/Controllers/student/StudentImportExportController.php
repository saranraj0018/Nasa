<?php

namespace App\Http\Controllers\student;

use App\Exports\StudentTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentImportExportController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new StudentTemplateExport, 'student_upload_template.xlsx');
    }

    public function uploadStudents(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        
        Excel::import(new StudentsImport, $request->file('file'));
        return back()->with('success', 'Students uploaded successfully');
    }
}
