<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockTimeSettings extends Model
{
    use HasFactory;

    protected $table = 'clock_time_settings';
    public $primaryKey = 'id';
    protected $fillable = [     
        'country',       
        'timezone',     
        'clock_comment', 
        'rfid',           
        'time_format',           
        'iprestriction',   
        'opt',           
    ];
}
