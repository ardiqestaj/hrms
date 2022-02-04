<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeClock extends Model
{
    use HasFactory;

    protected $table = 'time_clocks';
    public $primaryKey = 'id';
    protected $fillable = [     
        'reference',       
        'idno',     
        'date', 
        'employee',           
        'timein',           
        'timeout',   
        'totalhours',  
        'status_timein',           
        'status_timeout',           
        'reason',           
        'comment',           
    ];
}
