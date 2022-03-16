<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'rec_client_id',
        'location_name',
        'location_address',
        'location_email',
        'location_phone_number',
    ];
}
