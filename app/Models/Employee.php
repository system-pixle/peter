<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'salary',
        'paid_amount',
    ];

    // 🧮 Helper Methods
    public function getBalanceAttribute()
    {
        return $this->salary - $this->paid_amount;
    }

    public function getPaymentStatusAttribute()
    {
        return $this->paid_amount >= $this->salary ? 'Paid' : 'Pending';
    }
}
