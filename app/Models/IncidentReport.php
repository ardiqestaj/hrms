<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{

    use HasFactory;
    protected $table = 'incident_reports';
    public $primaryKey = 'id';
    protected $fillable = [
        'rep_employee_id',
        'rep_location_id',
        'rep_date',
        'rep_time',
        'rep_description',
        'read_at',
        'rep_image',
    ];
}
