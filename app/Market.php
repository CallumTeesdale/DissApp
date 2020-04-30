<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    //
    protected $fillable = [
        'id', 'name', 'price', 'barcode', 'description', 'live', 'created_at', 'updated_at', 'image'
    ];
}