<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    public $primaryKey = 'id';
    protected $fillable = [     
        'reference',       
        'idno',
        'employee',           
        'intime',           
        'outime',   
        'datefrom',  
        'dateto',           
        'hours',           
        'restday',           
        'archive',           
    ];
}
