<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill;
use App\product;
class statisticalController extends Controller
{
    public function sales(){
    	$sales=bill::select(bill::raw('count(*) as billQuantity, sum(total_price_final) as billTotalPrice, date_order'))->groupBy("date_order")->get();
    	return view("admin.statistical.sales")->with(compact("sales"));
    }
    public function stocking(){
    	$stocking=product::where("quantity_stock",">",0)->get();
    	return view("admin.statistical.stocking")->with(compact("stocking"));
    }
    public function outofstock(){
    	$outOfStock=product::where("quantity_stock",0)->get();
    	return view("admin.statistical.outOfStock")->with(compact("outOfStock"));
    }
}
