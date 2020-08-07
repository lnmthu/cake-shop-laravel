<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coupon;
class CouponController extends Controller
{
	public function getAjax($condition)
	{
		
	}
    public function getList()
    {
    	$coupon=coupon::all();
    	return view("admin.coupon.list",["coupon"=>$coupon]);

    }
    public function getAdd()
    {
    	return view("admin.coupon.add");
    }
    public function postAdd(Request $r)
    {
 
    	
		$coupon=new coupon();
		$coupon->name=$r->name;
		$coupon->code=$r->code;
		$coupon->qty=$r->qty;
		$coupon->condition=$r->condition;
		if($r->condition==0 && $r->number>=100)
			return redirect("admin/coupon/add")->with("loi","Làm ơn nhập số phần trăm giảm phải nhỏ hơn 100%");
		$coupon->number=$r->number;
		$coupon->active=$r->active;
		$coupon->save();
		return redirect("admin/coupon/add")->with("thongbao","Thêm thành công");
		
    }
    public function getEdit($id)
    {
    	$coupon=coupon::find($id);
    	return view("admin.coupon.edit",["coupon"=>$coupon]);
    }
    public function postEdit(Request $r, $id)
    {
		$coupon=coupon::find($id);
		$coupon->name=$r->name;
		$coupon->code=$r->code;
		$coupon->qty=$r->qty;
		$coupon->condition=$r->condition;
		if($r->condition==0 && $r->number>=100)
			return redirect("admin/coupon/edit/".$id)->with("loi","Làm ơn nhập số phần trăm giảm phải nhỏ hơn 100%");	
		$coupon->number=$r->number;
		$coupon->active=$r->active;
		$coupon->save();
		return redirect("admin/coupon/edit/".$id)->with("thongbao","Sửa thành công");
    }
    public function getDelete($id)
    {
		$coupon=coupon::find($id);
		$coupon->delete();
		return redirect("admin/coupon/list")->with("thongbao","Xóa thành công");
    }
    public function getActive($id)
    {
    	$coupon=coupon::find($id);
    	if($coupon->active==0)
		{
			$coupon->active=1;
			$coupon->save();
			return redirect("admin/coupon/list")->with("thongbao","Trạng thái mã giảm giá ".$coupon->name." đã kích hoạt");
		}
		else
		{
		$coupon->active=0;
		$coupon->save();
		return redirect("admin/coupon/list")->with("thongbao","Trạng thái mã giảm giá ".$coupon->name." chưa kích hoạt");
		}
    }

}
