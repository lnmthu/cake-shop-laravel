@extends("front.layout.index")

@section("content")

	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Quản lý đơn hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="">Trang chủ</a> / <span>Quản lý đơn hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->

	<div class="container">
		<div id="content">
			<div class="table-responsive">
						@if(session("thongbao"))
							<div class="alert alert-success">{{session("thongbao")}}</div>
							<?php session()->forget("thongbao");?>
						@endif
						@if(session("loi"))
							<div class="alert alert-danger">{{session("loi")}}</div>
							<?php session()->forget("loi");?>
						@endif
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-price">Mã đơn hàng</th>
							<th class="product-price">Ngày mua</th>
							<th class="product-name">Tên bánh</th>
							<th class="product-subtotal">Tổng tiền</th>
							<th class="product-price">Trạng thái đơn hàng</th>
						</tr>
					</thead>


					@foreach($bill as $b)
					<tbody>
						<td >
								<a href="managebilldetail/{{$b->id}}"><span class="amount" style="color: blue;">#{{$b->id}}</span></a>
						</td>
						<td >
								<span class="amount">{{$b->date_order}}</span>
						</td>
						<td >
							<div >
								@foreach($b->bill_detail as $detail)
								<div class="media-body">
									<p class="amount">{{$detail->product->name}}</p>
								</div>
								<br>
								@endforeach
							</div>
						</td>
						<td >
								<span class="amount">{{number_format($b->total_price_final,0,"",".")}} <u>đ</u></span>
						</td>
						<td >
							 @switch($b->active)
                                @case(0)
								<span class="amount">Đã tiếp nhận</span>
                                    @break
                                @case(2)
								<span class="amount">Giao hàng thành công</span>
                                @break
                                @case(3)
								<span class="amount">Đã hủy</span>
                                @break
                                @default
                                    @break
                            @endswitch
						</td>
					</tbody>
					@endforeach
				</table>
				<div class="row" style="text-align: center;">{{$bill->links()}}</div>


			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
