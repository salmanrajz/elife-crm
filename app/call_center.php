<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class call_center extends Model
{
    //
    protected $fillable = [
        'call_center_name','status','call_center_code','call_center_amount'
    ];
}
