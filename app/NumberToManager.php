<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberToManager extends Model
{
    //
    protected $fillable = [
        'num_id','userid', 'status', 'identity'
    ];
}
