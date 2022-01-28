<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplies extends Model
{
    use HasFactory;
    protected $table = 'leave_applies';
    public $primaryKey = 'leave_applies_id';
    protected $fillable = [
        'rec_id',
        'leave_type_id',
        'from_date',
        'to_date',
        'day',
        'leave_reason',
        'status',
        'approved_by'

    ];
}
