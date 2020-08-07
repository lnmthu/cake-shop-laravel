<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ward extends Model
{
	protected $table="ward";
	public function district()
	{
		return $this->belongsto("App\district","id_district","id");
	}	
}
