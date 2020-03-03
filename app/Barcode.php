<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    //
    public $timestamps = FALSE;
    public $fillable = [
        'id', 'item_id', 'barcode'
    ];
}