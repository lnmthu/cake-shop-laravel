<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table="city";
    public function district()
    {
    	return $this->hasMany("App\district","id_city","id");
    }
    public function ward()
    {
    	return $this->hasManyThrough('App\ward','App\district','id_city','id_district',"id");
    }
}
