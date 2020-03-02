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
        'id', 'form_data', 'category', 'creator_id', 'survey_title', 'survey_description', 'created_at', 'updated_at'
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }

    public function responses()
    {
        return $this->hasMany('App\Response', 'id_survey', 'id');
    }
}