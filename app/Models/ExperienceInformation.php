<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceInformation extends Model
{
    use HasFactory;
    protected $table = 'experience_information';
    public $primaryKey = 'exp_id';
    protected $fillable = [
        'rec_id',
        'work_company_name',
        'work_address',
        'work_position',
        'work_period_from',
        'work_period_to'
    ];
}
