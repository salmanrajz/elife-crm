<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberToUser extends Model
{
    //
    protected $fillable = [
        'num_id', 'userid', 'status', 'identity','manager_id'
    ];
}
