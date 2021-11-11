<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\city;


class usersController extends Controller
{
	public function getList()
	{
		$user=User::all();
		return view("admin.users.list",["user"=>$user]);
	}
	public function getAdd()
	{
		$city=city::all();
		return view("admin.users.add",["city"=>$city]);
	}
	public function postAdd(Request $r)
	{
		$user=new User();
		$user->name=$r->name;
		$user->email=$r->email;
		$user->password=bcrypt($r->pass);
		$user->quyen=$r->quyen;
		$u=$r->check;
		if($r->changeOption)
		{

			$user->phone_number=$r->phone_number;
			$user->id_city=$r->id_city;
			$user->id_district=$r->id_district;
			$user->id_ward=$r->id_ward;
			$user->address=$r->address;
			$user->note=$r->note;
			$user->gender=$r->gender;
		}
		$user->save();
		return redirect("admin/users/add")->with("thongbao","Thêm thành công");

	}

	public function getEdit($id)
	{
		$user=user::find($id);
		$city=city::all();
		return view("admin.users.edit",["user"=>$user,"city"=>$city]);
	}
	public function postEdit(Request $r,$id)
	{
		$user=User::find($id);
		$user->quyen=$r->quyen;
		$user->name=$r->name;

		if($r->changePass)
		{

			$user->password=bcrypt($r->pass);
		}
		if($r->changeOption)
		{

			$user->phone_number=$r->phone_number;
			$user->id_city=$r->id_city;
			$user->id_district=$r->id_district;
			$user->id_ward=$r->id_ward;
			$user->address=$r->address;
			$user->note=$r->note;
			$user->gender=$r->gender;
		}
		$user->save();
		return redirect("admin/users/edit/".$id)->with("thongbao","Sửa thành công");
	}
	public function getDelete($id)
	{
		$user=user::find($id);
        if($user->bill()->first())
            return redirect("admin/users/list")->with("loi","Xóa thất bại vì user này giao dịch trong các hoá đơn");
        $user->social()->delete();
		$user->delete();
		return redirect("admin/users/list")->with("thongbao","Xóa thành công");
	}

}

