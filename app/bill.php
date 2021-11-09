<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	protected $table="bill";
    public function user()
    {
    	return $this->belongsTo("App\User","id_user","id");
    }
    public function bill_detail()
    {
    	return $this->hasMany("App\bill_detail","id_bill","id");
    }
     public function coupon()
    {
    	return $this->belongsTo("App\coupon","id_coupon","id");
    }
}
