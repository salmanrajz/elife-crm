<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataentry extends Model
{
    //
    protected $fillable = [
        'company_name','authorize_person_name','authorize_person_number','company_number','email','company_address','remarks','location','conversion','userid'
    ];
}
