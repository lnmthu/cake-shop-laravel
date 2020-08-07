@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Doanh số
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->


                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Ngày đặt hàng</th>
                                <th>Số lượng hoá đơn</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $b)
                            <tr class="odd gradeX" align="center">
                                <td>
                                    {{$b->date_order}}<br>
                                </td>
                                <td>{{$b->billQuantity}}</td>
                                <td>{{$b->billTotalPrice}}</td>
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