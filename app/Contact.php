<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public $fillable = [
        'id', 'name', 'email', 'enquiry', 'created_at', 'updated_at'
    ];
}