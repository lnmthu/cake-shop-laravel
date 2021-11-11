@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session("thongbao"))
                            <div class="alert alert-success">
                                {{session("thongbao")}}<br>
                            </div>
                        @endif
                        @if(session("loi"))
                            <div class="alert alert-danger">
                                {{session("loi")}}<br>
                            </div>
                        @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Quyền</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Tỉnh/Thành phố</th>
                                <th>Quận/Huyện</th>
                                <th>Xã/Phường/Thị trấn</th>
                                <th>Địa chỉ</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                @if($u->quyen==0)
                                    <td>Thường</td>
                                @else
                                    <td>Admin</td>
                                @endif
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                @if($u->gender==1)
                                    <td>Nam</td>
                                @elseif($u->gender==2)
                                    <td>Nữ</td>
                                @elseif($u->gender==3)
                                    <td>Khác</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$u->phone_number}}</td>
                                @if($u->city&&$u->district&&$u->ward)
                                <td>{{$u->city->name}}</td>
                                <td>{{$u->district->name}}</td>
                                <td>{{$u->ward->name}}</td>
                                @else
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif
                                <td>{{$u->address}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/users/delete/{{$u->id}}">Xóa</a></td>
                                <td class="center"><a href="admin/users/edit/{{$u->id}}"><i class="fa fa-pencil fa-fw"></i></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
