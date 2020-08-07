@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mã giảm giá
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session("thongbao"))
                            <div class="alert alert-success">
                                {{session("thongbao")}}<br>
                            </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên</th>
                                <th>Mã giảm giá</th>
                                <th>Số lượng mã</th>
                                <th>Điều kiện giảm</th>
                                <th>Số tiền hoặc phần trăm giảm</th>
                                <th>Trạng thái</th>
                                <th>Chuyển trạng thái</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupon as $c)
                            <tr class="odd gradeX" align="center">
                                <td>{{$c->id}}</td>
                                <td>{{$c->name}}</td>
                                <td>{{$c->code}}</td>
                                <td>{{$c->qty}}</td>
                                @if($c->condition==0)
                                <td>{{"Giảm bằng phần trăm"}}</td>
                                <td>{{$c->number}}%</td>
                                @else
                                <td>{{"Giảm bằng giá tiền"}}</td>
                                <td>{{number_format($c->number,0,"",".")}} <u>đ</u></td>
                                @endif
                                <td>
                                    @if($c->active==1)
                                    {{"Đã kích hoạt"}}
                                    @else($c->active==0)
                                    {{"Chưa kích hoạt"}}
                                    @endif
                                </td>
                                <td class="center"><a href="admin/coupon/active/{{$c->id}}">Chuyển trạng thái</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/coupon/delete/{{$c->id}}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/coupon/edit/{{$c->id}}">Sửa</a></td>
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
