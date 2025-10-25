<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
    ];

    public function classes()
    {
        return $this->hasMany(Schoolclass::class, 'teacher_name', 'name');
    }
}
