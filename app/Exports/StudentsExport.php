<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function collection()
    {
        return Student::where('class', $this->class)
                      ->select('id', 'name', 'admission_number', 'class', 'fees_paid', 'created_at')
                      ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Admission No', 'Class', 'Fees Paid', 'Created At'];
    }
}
