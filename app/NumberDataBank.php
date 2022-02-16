<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberDataBank extends Model
{
    //
    protected $fillable = [
        'name','mobile','building','tenant_type','email','makani_eid','contract_date','status', 'identity'
    ];
}
