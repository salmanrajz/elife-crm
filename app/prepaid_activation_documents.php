<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prepaid_activation_documents extends Model
{
    //
    protected $fillable = [
        'username',
        'document_name',
        'lead_id',
        'activation_id',
        'status',
    ];
}
