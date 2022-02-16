<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class channel_partner extends Model
{
    //
    protected $fillable = [
        'name','type','status'
    ];
}
