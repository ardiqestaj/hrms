<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesEvidence extends Model
{
    use HasFactory;
    protected $table = 'leaves_evidence';
    public $primaryKey = 'leaves_evidence_id';
    protected $fillable = [
        'leave_applies_id',
        'leave_type_id',
        'rec_id',
        'day',
        'status',
        'from_date',
        'to_date'
    ];
}
