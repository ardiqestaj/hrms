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
        'payment_type',
        'salary_amount',
        'hourly_salary',
        'monthly_surcharge',
        'night_sunday_bon',
        'holiday_bon',
        'holiday_bon_minus',
        'timesupplement_night_sunday',
        'pension_insurance',
        'unemployment_insurance',
        'accident_insurance',
        'uvg_grb',
        'pension_fund',
        'medical_insurance',
        'collective_labor',
        'expenses',
        'telephone_shipment',
        'mileage_compensation',
    ];
}
