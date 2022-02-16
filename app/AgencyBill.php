<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyBill extends Model
{
    //
    protected $fillable = [
        'amount','userid','agency_id'
    ];
}
