@extends("admin.layout.index")
@section("content")

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">Trạng thái hóa đơn
                            <small>@switch($bill->active)
                                            @case(0)
                                                {{"Đã tiếp nhận"}}
                                                @break
                                            @case(1)
                                                {{"Đã xử lý"}}
                                            @break
                                            @case(2)
                                                {{"Giao hàng thành công"}}
                                            @break
                                            @case(3)
                                                {{"Đã hủy"}}
                                            @break
                                            @break
                                            @default
                                                @break
                                        @endswitch
                                </small>
                        </h1>                       
                         <h1 class="page-header">Chi tiết hóa đơn
                            <small>Thông tin vận chuyển</small>
                        </h1>

                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên khách hàng</th>
                                <th>E-mail</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Cách thức thanh toán</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>{{$bill->user->id}}</td>
                                <td>{{$bill->user->name}}</td>
                                <td>{{$bill->user->email}}</td>
                                <td>{{$bill->user->phone_number}}</td>
                                @if($bill->user->id_city && $bill->user->id_district && $bill->user->id_ward)
                                <td><?php echo $bill->user->address.", ".$bill->user->ward->name.", ".$bill->user->district->name.", ".$bill->user->city->name;?></td>
                                @else
                                <td></td>
                                @endif
                                <td>{{$bill->payment}}</td>
                                <td>{{$bill->note}}</td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết hóa đơn
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng trong kho</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng mua</th>
                                <th>Tổng tiền</th>
                                <th>Mã giảm giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill->bill_detail as $d)
                            <tr class="odd gradeX" align="center">
                                <td>{{$d->id}}</td>
                                <td>{{$d->product->name}}</td>
                                <td>{{$d->product->quantity_stock}}</td>
                                <td>{{number_format($d->product->unit_price)}} VND</td>
                                @if($d->product->promotion_price)
                                <td>{{number_format($d->product->promotion_price)}} VND</td>
                                <td>{{$d->quantity}}</td>
                                <td>{{number_format($d->product->promotion_price*$d->quantity)}} VND</td>
                                @else
                                <td></td>
                                <td>{{$d->quantity}}</td>
                                <td>{{number_format($d->product->unit_price*$d->quantity)}} VND</td>
                                @endif
                                 @if($bill->id_coupon)
                                <td>{{$bill->coupon->name}}</td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                                <strong><mark>Tạm tính: {{number_format($bill->total_price_first)}} VND<br>
                                @if($bill->id_coupon)
                                Phí giảm giá: @if($bill->coupon->number<=100){{number_format(($bill->coupon->number*$bill->total_price_first)/100)}}@else{{number_format($bill->coupon->number)}}@endif VND<br>
                                @endif
                                Phí vận chuyển: {{number_format($bill->feeship)}} VND<br>
                                Thành tiền: {{number_format($bill->total_price_final)}} VND<br>
                                </mark><strong>
                            <div class="col-lg-12">
                                <h1><a target="_blank" href="prinfBillDetail/{{$bill->id}}">In đơn hàng</a></h1>
                            </div>

                                        

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
                               
