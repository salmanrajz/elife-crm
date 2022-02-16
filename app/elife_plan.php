<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class elife_plan extends Model
{
    //
    protected $fillable = [
        'plan_name',
        'speed',
        'devices',
        'monthly_charges',
        'installation_charges',
        'contract',
        'revenue',
        'status','product_type'
    ];
}
