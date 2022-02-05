<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationTypeWork extends Model
{
    use HasFactory;
    protected $table = 'location_type_works';
    public $primaryKey = 'location_type_work_id';
    protected $fillable = [
    'location_id',
    'type_work_id',
    'number_of_employees'
    ];
}
