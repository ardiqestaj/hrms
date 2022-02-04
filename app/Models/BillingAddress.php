<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        'address_identifier',
        'firstname',
        'lastname',
        'street_address',
        'city',
        'state',
        'country',
        'zip_code',
        'phone_number',
        'email',
    ];
}
