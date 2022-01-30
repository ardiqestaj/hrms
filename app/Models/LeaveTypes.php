<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTypes extends Model
{
    use HasFactory;
    protected $table = 'leave_types';
    public $primaryKey = 'leave_id';
    protected $fillable = [
        'leave_names',
        'leave_days'
    ];
}
