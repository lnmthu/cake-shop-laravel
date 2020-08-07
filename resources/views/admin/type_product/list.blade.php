@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->


                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeProduct as $type)
                            <tr class="odd gradeX" align="center">
                                <td>{{$type->id}}</td>
                                <td>
                                    {{$type->name}}<br>
                                </td>
                                <td>{{$type->description}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/typeProduct/delete/{{$type->id}}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/typeProduct/edit/{{$type->id}}">Sửa</a></td>
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