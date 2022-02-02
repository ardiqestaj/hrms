<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $primaryKey = 'client_id';
    protected $fillable = [     
        'rec_client_id',       
        'client_name',     
        'contact_person', 
        'client_address',     
        'client_email',      
        'client_mobile_phone',        
        'client_fax_phone'    
    ];

}
