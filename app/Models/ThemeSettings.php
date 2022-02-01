<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSettings extends Model
{
    use HasFactory;

    protected $table = 'theme_settings';
    public $primaryKey = 'id';
    protected $fillable = [     
        'website_name',       
        'website_logo',     
        'website_favicon',           
    ];
}
