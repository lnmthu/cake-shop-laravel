<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	protected $table="social";
	public function user(){
    return $this->belongsto("App\User","id_user","id");
}
}
