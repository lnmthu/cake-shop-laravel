@extends("front.layout.index")

@section("content")

	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Chi tiết đơn hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="">Trang chủ</a> / <span>Chi tiết đơn hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<br>	 -->
	<div class="container">
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
				<h3>Trạng thái đơn hàng #{{$bill->id}}:
				 @switch($bill->active)
                        @case(0)
						Đã tiếp nhận
                            @break
                        @case(2)
						Giao hàng thành công
                        @break
                        @case(3)
						Đã hủy
                        @break
                        @default
                            @break
                    @endswitch
                </h3><br>
					<?php $user=Auth::user()?>
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Khách hàng</th>
							<th class="product-price">E-mail</th>
							<th class="product-quantity">Số điện thoại</th>
							<th class="product-subtotal">Địa chỉ</th>
							<th class="product-subtotal">Thanh toán</th>
							<th class="product-subtotal">Ghi chú</th>
						</tr>
					</thead>

					<tbody>

							<td class="product-name">
								<span class="amount">{{$user->name}}</span>
							</td>
							<!--Update all cart-->

							<td class="product-price">
  								<span class="amount">{{$user->email}}</span>
							</td>
							<!---->
							<td class="product-quantity">
								<span class="amount">{{$user->phone_number}}</span>
							</td>
							<td class="product-subtotal">
								<span class="amount">{{$user->address.", ".$user->ward->name.", ".$user->district->name.", ".$user->city->name}}</span>
							</td>
							<td class="product-subtotal">
								@switch($bill->payment)
	                                @case("ATM")
									<span class="amount">Chuyển khoản</span>
	                                    @break
	                                @case("COD")
									<span class="amount">Thanh toán tiền mặt</span>
	                                @break
	                                @default
	                                    @break
	                            @endswitch
							</td>
							<td class="product-subtotal">
								<span class="amount">{{$user->note}}</span>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Tên bánh</th>
							<th class="product-price">Giá</th>
							<th class="product-quantity">Số lượng</th>
							<th class="product-subtotal">Tổng giá</th>
						</tr>
					</thead>

					@foreach($bill_detail as $detail)
					<tbody>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img width="100px" class="pull-left" src="image/product/{{$detail->product->img}}" alt="">
									<div class="media-body">
										<p class="font-large table-title">{{$detail->product->name}}</p>
									</div>
								</div>
							</td>
							<td class="product-price">
								<span class="amount">{{number_format($detail->unit_price,0,"",".")}} <u>đ</u></span>
							</td>
							<!--Update all cart-->

							<td class="product-quantity">
  								<span class="amount">{{$detail->quantity}}</span>
							</td>
							<!---->

						</td>
							<td class="product-subtotal">
								<span class="amount">{{number_format($detail->unit_price* $detail->quantity,0,"",".")}} <u>đ</u></span>
							</td>
						</tr>
					</tbody>
					@endforeach


				</table>
				<!-- End of Shop Table Products -->
			</div>


			<!-- Cart Collaterals -->
			<div class="cart-collaterals">
				<div class="cart-totals pull-right">
				<!--	<div class="cart-totals-row"><span>Cart Subtotal:</span> <span>$188.00</span></div>
					<div class="cart-totals-row"><span>Shipping:</span> <span>Free Shipping</span></div>-->
					<div class="cart-totals-row"><h5 class="cart-total-title">Tổng giỏ hàng</h5></div>
					<div class="cart-totals-row"><span>Tạm tính:</span> <span>
					{{number_format($bill->total_price_first,0,"",".")}} <u>đ</u></span></div>
					@if($bill->id_coupon)
						@if($bill->coupon->condition==0)
							<div class="cart-totals-row"><span>Giảm giá:</span> <span>{{number_format($bill->total_price_first*$bill->coupon->number,0,"",".")}} <u>đ</u></span></div>

						@else
							<div class="cart-totals-row"><span>Giảm giá:</span> <span>{{number_format($bill->coupon->number,0,"",".")}} <u>đ</u></span></div>

						@endif
					@endif
					<div class="cart-totals-row"><span>Phí vận chuyển:</span> <span>{{number_format($bill->feeship,0,"",".")}} <u>đ</u></span></div>
					<div class="cart-totals-row"><span>Thành tiền:</span> <span>{{number_format($bill->total_price_final,0,"",".")}} <u>đ</u></span></div>
					@if($bill->active!=3)
							@csrf
							<a class="beta-btn primary" href="cancelbill/{{$bill->id}}" >Hủy đơn hàng <i class="fa fa-chevron-right"></i></a>
					@endif
						<br>

				</div>

				<div class="clearfix"></div>
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>
				<!-- End of Shop Table Products -->
			</div>
		</div> <!-- #content -->

	</div> <!-- .container -->
	<br>
@endsection

