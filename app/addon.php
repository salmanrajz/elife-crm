<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class addon extends Model
{
    //
    protected $fillable = [
        'addon_name',
        'status',
        'package_id',
        'amount',
    ];
}
