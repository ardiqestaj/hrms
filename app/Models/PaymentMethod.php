<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    public $primaryKey = 'id';
    protected $fillable = [
        'company_name',
        'company_contact',
        'company_address',
        'company_country',
        'company_city',
        'company_province',
        'company_postal_code',
        'company_email',
        'company_phone_number',
        'company_mobile_number',
        'company_fax',
        'company_website',
    ];
}
