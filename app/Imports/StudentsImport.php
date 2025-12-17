<?php

namespace App\Imports;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        echo '<pre>';
        print_r($this->transformDate($row['date_of_birth']));
        echo '</pre>';
        exit;

        return new Student([
            'department_id'  => $row['department_id'],
            'programme_id'   => $row['programme_id'],
            'name'           => $row['name'],
            'email'          => $row['email'],
            'mobile_number'  => $row['mobile_number'],
            'password'       => Hash::make($row['mobile_number']),
            'date_of_birth'  => $row['date_of_birth'],
            'gender'         => $row['gender'],
        ]);
    }

    private function transformDate($value)
    {
        try {
            if (is_numeric($value)) {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            echo '</pre>';
            exit;
            return null;
        }
    }

    public function rules(): array
    {
        return [
            // 'department_id' => 'required',
            // 'programme_id'  => 'required',
            // 'name'          => 'required',
            // 'email'         => 'required',
            // 'mobile_number' => 'required',
            // 'password'      => 'required',
            // 'gender'        => 'required',
        ];
    }

}
