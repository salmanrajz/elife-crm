<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prepaid_sale extends Model
{
    //
    protected $fillable = [
        'lead_no','kiosk_id','customer_name','customer_number','country','age','product_type','plan','gender','emirate','document_type','document','document_no','language','saler_id','status','emirate_expiry','date_of_birth','front_document','back_document','amount','sr_number'
    ];
}
