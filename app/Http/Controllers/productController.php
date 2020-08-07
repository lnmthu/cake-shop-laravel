<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\type_product;

class productController extends Controller
{
	public function getList()
	{
		$product=product::all();
		return view("admin.product.list",["product"=>$product]);
	}  
	public function getAdd()
	{
		$type=type_product::all();
		return view("admin.product.add",["type"=>$type]);
	}  
	public function postAdd(Request $r)
	{
		 $this->validate($r,
						[
							"title"=>"required",
							"keywords"=>"required",
						],
						[
							"title.required"=>"Làm ơn nhập tiêu đề",
							"keywords.required"=>"Làm ơn nhập từ khóa",
						]);

		$product=new product();
		$product->name=$r->name;
		$product->id_type=$r->id_type;
		$product->description=$r->description;
		$product->unit_price=$r->unit_price;
		$product->quantity_stock=$r->quantity_stock;
		$product->title=$r->title;
		$product->keywords=$r->keywords;
		$product->active=$r->active;

		if($r->changeOption)
			if($r->promotion_price>$r->unit_price)
            	return redirect("admin/product/add")->with ("loi",'Làm ơn nhập giá khuyến mãi nhỏ hơn giá gốc');
            else	
				$product->promotion_price=$r->promotion_price;
		//img
		if($r->hasfile("img"))
		{	
			 
			$file=$r->file("img");
			$duoi=$file->getClientOriginalExtension();
        	if($duoi!="jpg" && $duoi!="png" && $duoi!= "jpeg")
            	return redirect("admin/product/add")->with ("loi",'Làm ơn chọn hình có đuôi ".jpg" hoặc ".png" hoặc ".jpeg"');	
	        $name=$file->getClientOriginalName();
	        $hinh=rand()."_".$name;
	        while (file_exists("image/product/".$hinh)) {
	              $hinh=rand()."_".$name;
	         }
	         $file->move("image/product/",$hinh);
	         $product->img=$hinh;
     	}	
		//img
		$product->save();
		return redirect("admin/product/add")->with("thongbao","Thêm thành công");
	} 
	
	public function getEdit($id)
	{
		$product=product::find($id);
		$type=type_product::all();
		return view("admin.product.edit",["product"=>$product,"type"=>$type]);
	}
	public function postEdit(Request $r,$id)
	{
		 $this->validate($r,
						[
							"title"=>"required",
							"keywords"=>"required",
						],
						[
							"title.required"=>"Làm ơn nhập tiêu đề",
							"keywords.required"=>"Làm ơn nhập từ khóa",
						]);

		$product=product::find($id);
		$product->name=$r->name;
		$product->id_type=$r->id_type;
		$product->description=$r->description;
		$product->unit_price=$r->unit_price;
		$product->quantity_stock=$r->quantity_stock;
		$product->title=$r->title;
		$product->keywords=$r->keywords;
		$product->active=$r->active;
		if($r->changeOption)
			if($r->promotion_price>$r->unit_price)
            	return redirect("admin/product/add")->with ("loi",'Làm ơn nhập giá khuyến mãi nhỏ hơn giá gốc');
            else	
				$product->promotion_price=$r->promotion_price;
		if($r->hasfile("img"))
		{	
			
			$file=$r->file("img");
       		 $duoi=$file->getClientOriginalExtension();
        	if($duoi!="jpg" && $duoi!="png" && $duoi!= "jpeg")
            	return redirect("admin/product/edit/".$id)->with ("loi",'Làm ơn chọn hình có đuôi ".jpg" hoặc ".png" hoặc ".jpeg"');	
        	$name=$file->getClientOriginalName();
       		$hinh=rand()."_".$name;
        	while (file_exists("image/product/".$hinh)) {
             	 $hinh=rand()."_".$name;
         }
         $file->move("image/product/",$hinh);
         if(file_exists("image/product/".$product->img))
				unlink(public_path("image/product/".$product->img));
         $product->img=$hinh;

		}
		$product->save();
		return redirect("admin/product/edit/".$id)->with("thongbao","Sửa thành công");
	}
	public function getDelete($id)
	{
		$product=product::find($id);
		$product->delete();
		return redirect("admin/product/list")->with("thongbao","Xóa thành công");
	}
	  
}
