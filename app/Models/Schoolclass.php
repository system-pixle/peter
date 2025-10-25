<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teacher_name', 'description'];

    // ✅ One class has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}


