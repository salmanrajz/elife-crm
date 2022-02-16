<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kiosk_id extends Model
{
    //
    protected $fillable = [
        'name','location','agency_id','status'
    ];
}
