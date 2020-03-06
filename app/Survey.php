<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'form_data', 'category', 'user_id', 'survey_title', 'survey_description', 'created_at', 'updated_at'
    ];
}
