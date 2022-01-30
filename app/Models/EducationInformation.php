<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_id',
        'institution',
        'subject',
        'st_date',
        'end_date',
        'degree',
        'grade',
    ];

}
