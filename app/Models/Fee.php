<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'term',
        'amount_due',
        'amount_paid',
        'payment_date',
    ];

    // 🧩 Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function breakdowns()
    {
        return $this->hasMany(FeeBreakdown::class);
    }

    // 🧮 Accessors / Helpers
    public function getBalanceAttribute()
    {
        return $this->amount_due - $this->amount_paid;
    }

    public function getTotalBreakdownAttribute()
    {
        return $this->breakdowns->sum('amount');
    }
}
