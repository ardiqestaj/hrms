<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
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
        'restdays',
        'time_start',
        'time_end',
        'restdays_opt',
        'time_start_opt',
        'time_end_opt',
    ];
}
