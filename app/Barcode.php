<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    //
    public $timestamps = FALSE;
    public $fillable = [
        'id', 'market_id', 'barcode'
    ];
}
