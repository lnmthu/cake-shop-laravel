<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
	protected $table="district";
	public function city()
	{
		return $this->belongsTo("App\city","id_city","id");
	}
	public function ward()
	{
			return $this->hasMany("App\ward","id_district","id");
	}

}
