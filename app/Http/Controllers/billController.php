<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill;
use App\product;

class billController extends Controller
{
	public function getList()
	{
		$bill=bill::all();
		return view("admin.bill.list",["bill"=>$bill]);
	}  	  
	public function active(Request $r)
	{
		$bill=bill::find($r->id);
		$oldActive=$bill->active;
		$bill->active=$r->active;
		$bill->save();
		
		if($bill->active==3)
		{
			foreach ($bill->bill_detail as $d) {
				$product=product::find($d->id_product);
				$product->quantity_stock+=$d->quantity;
				$product->quantity_sold-=$d->quantity;
				$product->save();
			}
		}
	}


}


