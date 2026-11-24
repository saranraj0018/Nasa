<?php

namespace App\Exports;

use App\Http\Controllers\CreditSummaryReportController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CreditSummaryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $rows;
    protected $report;

    public function __construct($rows, array $report)
    {
        $this->rows = $rows;
        $this->report = $report;
    }

    public function collection()
    {
        $fmt = fn ($v) => CreditSummaryReportController::formatCredits($v);
        $required = $this->report['required'];

        return $this->rows->values()->map(function ($row, $index) use ($fmt, $required) {
            $student = $row['student'];

            $events = $row['events']->map(function ($event) use ($fmt) {
                $text = $event['title'] . ' - ' . $fmt($event['credits']);

                return $event['note'] ? $text . ' (' . $event['note'] . ')' : $text;
            })->implode(', ');

            return [
                $index + 1,
                $student->register_number,
                $student->name,
                $student->get_programme?->name,
                $student->semester,
                strtoupper((string) $student->section),
                $events ?: 'No Events',
                $fmt($required),
                $fmt($row['earned']),
                $fmt($row['remaining']),
                $row['completed'] ? 'Completed' : 'Pending',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Register Number',
            'Student Name',
            'Programme',
            'Semester',
            'Section',
            'Attended Events',
            'Required Credits',
            'Earned Credits',
            'Remaining Credits',
            'Status',
        ];
    }
}
