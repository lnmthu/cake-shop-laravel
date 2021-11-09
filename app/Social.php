<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	protected $table="social";
	public function user(){
    return $this->belongsTo("App\User","id_user","id");
}
}
