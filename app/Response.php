<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    const UPDATED_AT = null;
    //
    protected $fillable = [
        'id_survey', 'response', 'user_id', 'response_date',
    ];
}
