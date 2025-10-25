<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admission_no',
        'class_id',
        'gender',
        'dob',
        'parent_name',
        'contact',
    ];

    // ✅ Define relationship to Schoolclass
    public function schoolclass()
    {
        return $this->belongsTo(\App\Models\Schoolclass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}