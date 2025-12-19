<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Programme;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        $department = Department::where('name', trim($row['department_id']))->first();
        $programme  = Programme::where('name', trim($row['programme_id']))->first();

        return new Student([
            'department_id' => $department?->id,
            'programme_id'  => $programme?->id,
            'name'          => $row['name'],
            'email'         => $row['email'],
            'mobile_number' => $row['mobile_number'],
            'password'      => Hash::make($row['mobile_number']),
            'date_of_birth' => $this->transformDate($row['date_of_birth'] ?? null),
            'gender'        => $row['gender'],
        ]);
    }

    private function transformDate($value)
    {
        if (!$value) {
            return null;
        }

        if (is_numeric($value)) {
            return Carbon::instance(
                Date::excelToDateTimeObject($value)
            )->format('Y-m-d');
        }

        return Carbon::parse($value)->format('Y-m-d');
    }


    public function rules(): array
    {
        return [
            '*.department_id' => ['required', Rule::exists('departments', 'name')],
            '*.programme_id'  => ['required', Rule::exists('programmes', 'name')],
            '*.name'          => 'required',
            '*.email'         => ['required', 'email', 'distinct', Rule::unique('students', 'email')],
            '*.mobile_number' => 'required|digits:10',
            '*.gender'        => 'required|in:male,female,other',
        ];
    }

    // public function customValidationMessages()
    // {
    //     return [
    //         '*.email.unique'   => 'Email already exists.',
    //         '*.email.distinct' => 'Duplicate email found in Excel.',
    //         '*.department_id.exists' => 'Department name not found.',
    //         '*.programme_id.exists'  => 'Programme name not found.',
    //     ];
    // }
}
