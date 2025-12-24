<?php

namespace App\Exports;

use App\Models\StudentAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    public function collection()
    {
        return StudentAttendance::with('student')->where('event_id', $this->event_id)->get()->map(function ($row, $index) {
            return [
                'S.No'       => $index + 1,
                'Name'       => $row->student->name ?? '',
                'Department' => $row->student?->get_department?->name ?? '',
                'Section'    => $row->student?->section ?? '',
                'Phone'      => $row->student?->mobile_number ?? '',
                'Email'      => $row->student?->email ?? '',
                'Entry Time' => $row->entry_time ?? '',
                'Exit Time'  => $row->exit_time ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Department',
            'Section',
            'Phone',
            'Email',
            'Entry Time',
            'Exit Time',
        ];
    }
}
