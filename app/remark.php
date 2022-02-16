<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class remark extends Model
{
    //
    protected $fillable = [
        'remarks',
        'lead_status',
        'lead_id',
        'remarks',
        'lead_no',
        'date_time',
        'user_agent',
        'user_agent_id',

    ];
}
