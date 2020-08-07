@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Còn</small>
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
                                <th>Số lượng trong kho</th>
                                <th>Số lượng đã bán</th>
                                <th>Tên</th>
                                <th>Loại sản phẩm</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocking as $p)
                            <tr class="odd gradeX" align="center">
                                <td>{{$p->quantity_stock}}</td>
                                <td>{{$p->quantity_sold}}</td>

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
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

                 
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

                <!-- /.row -->