<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table = 'holidays';
    public $primaryKey = 'id';
    protected $fillable = [
        'title',
        'start',
        'end'

    ];
}
