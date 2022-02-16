<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class remarks_elife_number extends Model
{
    //
    protected $fillable = [
        'number','number_id','userid','follow_date','remarks','other_remarks','status','lead_id'
    ];
}
