<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_product extends Model
{
	protected $table="type_product";
	public function product(){
    return $this->hasMany("App\product","id_type","id");
}
}
