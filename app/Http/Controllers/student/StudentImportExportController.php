<?php

namespace App\Http\Controllers\student;

use App\Exports\StudentTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentImportExportController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new StudentTemplateExport, 'student_upload_template.xlsx');
    }

    public function uploadStudents(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|mimes:xlsx'
            ]);

            Excel::import(new StudentsImport, $request->file('file'));
            return back()->with('success', 'Students Uploaded Successfully');
        } catch (ValidationException $e) {
            // Load uploaded Excel
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            echo '<pre>';
            print_r($e->failures());
            echo '<pre>';
            exit;
            // Find last column
            $highestColumn = $sheet->getHighestColumn();
            $errorColumn = ++$highestColumn;

            // Add heading
            $sheet->setCellValue($errorColumn . '1', 'Errors');

            foreach ($e->failures() as $failure) {
                $rowNumber = $failure->row();
                $sheet->setCellValue(
                    $errorColumn . $rowNumber,
                    implode(', ', $failure->errors())
                );
            }

            // Save & return
            $fileName = 'students_with_errors.xlsx';
            $tempPath = storage_path('app/' . $fileName);

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($tempPath);

            return response()->download($tempPath)->deleteFileAfterSend();
        }
    }
}
