<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeBreakdown extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = [
        'term',
        'description',
        'amount',
        'fee_id',
    ];

    /**
     * Relationship: Each fee breakdown belongs to a specific fee record
     */
    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
