<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'email',
        'role_name',
        'phone_number',
        'birth_date',
        'employee_id',
        'company',
        'gender',
        'department',
        'payment_method',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'time_start',
        'time_end',
    ];
}
