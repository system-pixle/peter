<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount_due',
        'amount_paid',
        'term',
        'payment_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getBalanceAttribute()
    {
        return $this->amount_due - $this->amount_paid;
    }
}
