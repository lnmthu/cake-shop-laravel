@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
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
                                <th>Loại sản phẩm</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng còn trong kho</th>
                                <th>Số lượng đã bán</th>
                                <th>Mô tả</th>
                                <th>Tiều đề</th>
                                <th>Từ khóa</th>
                                <th>Trạng thái</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                            <tr class="odd gradeX" align="center">
                                <td>{{$p->id}}</td>
                                <td>
                                    {{$p->name}}<br>
                                    <img width="100px" src="image/product/{{$p->img}}">
                                </td>
                                <td>{{$p->type_product->name}}</td>
                                <td>{{number_format($p->unit_price,0,"",".")}} <u>đ</u></td>
                                @if($p->promotion_price)
                                <td>{{number_format($p->promotion_price,0,"",".")}} <u>đ</u></td>
                                @else
                                <td></td>
                                @endif
                                <td>{{$p->quantity_stock}}</td>
                                <td>{{$p->quantity_sold}}</td>
                                <td>{{$p->description}}</td>
                                <td>{{$p->title}}</td>
                                <td>{{$p->keywords}}</td>
                                <td>
                                    @if($p->active==1)
                                    {{"Đã kích hoạt"}}
                                    @else($p->active==0)
                                    {{"Chưa kích hoạt"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/product/delete/{{$p->id}}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product/edit/{{$p->id}}">Sửa</a></td>
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