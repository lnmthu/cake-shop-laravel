<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\type_product;
use App\product;

class type_productController extends Controller
{
	public function getList()
	{
		$typeProduct=type_product::all();
		return view("admin.type_product.list",["typeProduct"=>$typeProduct]);
	}
	public function getAdd()
	{
		return view("admin.type_product.add");
	}
	public function postAdd(Request $r)
	{
		$type=new type_product();
		$type->name=$r->name;
		$type->description=$r->description;

		$type->save();
		return redirect("admin/typeProduct/add")->with("thongbao","Thêm thành công");
	}

	public function getEdit($id)
	{
		$type=type_product::find($id);
		return view("admin.type_product.edit",["type"=>$type]);
	}
	public function postEdit(Request $r,$id)
	{

		$type=type_product::find($id);
		$type->name=$r->name;
		$type->description=$r->description;
		//var_dump($r->hasfile("img"));die();

		$type->save();
		return redirect("admin/typeProduct/edit/".$id)->with("thongbao","Sửa thành công");
	}
	public function getDelete($id)
	{
		$prod=product::where("id_type",$id)->first();
		$type=type_product::find($id);
		if($prod)
			return redirect("admin/typeProduct/list")->with("loi","Xóa thất bại vì tồn tại các sản phẩm chứa loại sản phẩm này");
		$type->delete();
		return redirect("admin/typeProduct/list")->with("thongbao","Xóa thành công");
	}

}
