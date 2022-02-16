<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class numberdetail extends Model
{
    //
    protected $fillable = [
        'number',
        'passcode',
        'remarks',
        'type',
        'channel_type',
        'book_type',
    ];
}
