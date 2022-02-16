<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billing_sale extends Model
{
    //
    protected $fillable = [
        'lead_no','kiosk_id','customer_name','customer_number','email','product_type','amount','remarks','status','saler_id', 'sale_type','agency_id'
    ];
}
