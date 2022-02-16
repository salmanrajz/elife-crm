<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postpaid_sales extends Model
{
    //
    protected $fillable = [
        'lead_no', 'kiosk_id', 'customer_name', 'customer_number', 'country', 'age', 'product_type', 'plan', 'addon', 'zone', 'gender', 'emirate', 'document_type', 'document', 'document_no', 'language', 'address', 'vila', 'street', 'area', 'makani', 'location_name', 'lat', 'lng', 'saler_id', 'remarks', 'front_document', 'back_document', 'sr_number', 'sr_doc', 'sale_type','selected_number','selected_plan','pay_status','pay_charges','status'
    ];
}
