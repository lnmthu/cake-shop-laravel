<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\city;
class apiusercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return view("admin.users.list",["user"=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city=city::all();
        return view("admin.users.add",["city"=>$city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $user=new User();
        $user->name=$r->name;
        $user->email=$r->email;
        $user->password=bcrypt($r->pass);
        $user->quyen=$r->quyen;
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
        return redirect("admin/users/create")->with("thongbao","Thêm thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=user::find($id);
        $city=city::all();
        return view("admin.users.edit",["user"=>$user,"city"=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
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
        return redirect("admin/users/".$id."/edit")->with("thongbao","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=user::find($id);
        $user->delete();
        return redirect("admin/users")->with("thongbao","Xóa thành công");
    }
}
