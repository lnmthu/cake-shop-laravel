<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feeship extends Model
{
	protected $table="feeship";
    public $timestamps = false;
    public function ward()
    {
        return $this->belongsTo("App\ward","id_ward","id");
    }
    public function city()
    {
    	return $this->belongsTo("App\city","id_city","id");
    }
    public function district()
    {
    	return $this->belongsTo("App\district","id_district","id");
    }

}
