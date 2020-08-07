<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slide;
class slideController extends Controller
{
	public function getList()
	{
		$slide=slide::all();
		return view("admin.slide.list",["slide"=>$slide]);
	}
     public function getAdd()
    {
    	return view("admin.slide.add");
    }
    public function postAdd(Request $r)
    {
    	$slide=new slide();
    	$slide->name=$r->name;
    	$slide->active=$r->active;
    	$file=$r->file("img");
		$duoi=$file->getClientOriginalExtension();
		if($duoi!="jpg" && $duoi!="png" && $duoi!= "jpeg")
	    	return redirect("admin/slide/add")->with ("loi",'Làm ơn chọn hình có đuôi ".jpg", ".png", ".jpeg"');	
	    $name=$file->getClientOriginalName();
	    $hinh=rand()."_".$name;
	    while (file_exists("image/slide/".$hinh)) {
	          $hinh=rand()."_".$name;
	     }
	    $file->move("image/slide/",$hinh);
	    $slide->img=$hinh;
        $slide->save();
    	return redirect("admin/slide/add")->with ("thongbao",'Thêm thành công');	
    }
    public function getEdit($id){
    	$slide=slide::find($id);
		return view("admin.slide.edit",["slide"=>$slide]);
    }
    public function postEdit(Request $r,$id)
    {
    	$slide=slide::find($id);
    	$slide->name=$r->name;
    	$slide->active=$r->active;
    	if($r->hasfile("img"))
    	{
    		if(file_exists("image/slide/".$slide->img))
    			unlink(public_path("image/slide/".$slide->img));
    		$file=$r->file("img");
    		$duoi=$file->getClientOriginalExtension();
    		if($duoi!="jpg" && $duoi!="jpeg" && $duoi!="png")
    			return redirect("admin/slide/edit/".$slide->id)->with("loi",'Làm ơn chọn hình ảnh có đuôi là ".jpg", ".ipeg", ".png" ');
    		$name=$file->getClientOriginalName();
    		$newname=rand()."_".$name;
    		while(file_exists("image/slide/".$newname))
    		{
    			$newname=rand()."_".$name;
    		}
    		$file->move("image/slide/",$newname);
    		$slide->img=$newname;
    	}
    	$slide->save();
		return redirect("admin/slide/edit/".$slide->id)->with("thongbao",'Sửa thành công');
    }
    public function getDelete($id)
    {
    	$slide=slide::find($id);
    	if(file_exists("image/slide/".$slide->img))
    			unlink(public_path("image/slide/".$slide->img));
    	$slide->delete();
    	return redirect("admin/slide/list")->with("thongbao","Xóa thành công");
    }
}
