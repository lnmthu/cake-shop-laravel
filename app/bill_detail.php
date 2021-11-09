<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
	protected $table="bill_detail";
    public function bill()
    {
    	return $this->belongsTo("App\bill","id_bill","id");
    }
    public function product()
    {
    	return $this->belongsTo("App\product","id_product","id");
    }
}
