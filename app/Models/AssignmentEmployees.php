<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentEmployees extends Model
{
    use HasFactory;
    protected $table = 'assignment_employee';
    public $primaryKey = 'assignment_id';
    protected $fillable = [
    'location_type_work_id',
    'employee_id'
    ];
}
