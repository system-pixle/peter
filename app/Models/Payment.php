<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount_paid',
        'term',
        'payment_date',
        'payment_method',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
