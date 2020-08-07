<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feeship extends Model
{
	protected $table="feeship";
    public $timestamps = false;
    public function ward()
    {
        return $this->belongsto("App\ward","id_ward","id");
    }
    public function city()
    {
    	return $this->belongsto("App\city","id_city","id");
    }
    public function district()
    {
    	return $this->belongsto("App\district","id_district","id");
    }
    
}
