<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassExport implements FromCollection, WithHeadings
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function collection()
    {
        return Student::where('class', $this->class)
            ->get(['name', 'attendance', 'fees_paid', 'fees_balance']);
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Attendance (%)',
            'Fees Paid',
            'Fees Balance',
        ];
    }
}
