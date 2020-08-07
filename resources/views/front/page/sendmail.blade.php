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
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Tên bánh</th>
							<th class="product-price">Giá</th>
							<th class="product-quantity">Số lượng.</th>
							<th class="product-subtotal">Tổng giá</th>
						</tr>
					</thead>
					@if(Cart::content())
						@foreach(Cart::content() as $c)
					<tbody>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img width="100px" class="pull-left" src="image/product/{{$c->img}}" alt="">
									<div class="media-body">
										<p class="font-large table-title">{{$c->name}}</p>
										<input type="hidden" value="{{$c->rowId}}" id="rowId">
									</div>
								</div>
							</td>

							<td class="product-price">
								<span class="amount">{{number_format($c->price,0,"",".")}}</span>
							</td>
							<td class="product-quantity">
								<span class="amount">{{$c->qty}}</span>
							</td>

							<td class="product-subtotal">
								<span class="amount">{{number_format($c->qty * $c->price,0,"",".")}}</span>
							</td>
						</tr>
					</tbody>
						@endforeach
					@endif
				</table>
				<!-- End of Shop Table Products -->
			</div>


			<!-- Cart Collaterals -->
			<div class="cart-collaterals">
				<div class="cart-totals pull-right">
					<!-- <div class="cart-totals-row"><h5 class="cart-total-title">Tổng giỏ hàng</h5></div>
					<div class="cart-totals-row"><span>Cart Subtotal:</span> <span>$188.00</span></div>
					<div class="cart-totals-row"><span>Shipping:</span> <span>Free Shipping</span></div>
					<div class="cart-totals-row"><span>Tổng tiền:</span>{{Cart::priceTotal(0)}} VND <span></span></div> -->
					<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
										<div  ><p class="your-order-f18">Tạm tính:</p></div>
										<div  ><h5 class="color-black">{{Cart::priceTotal(0,"",".")}} <u>đ</u></h5></div>
								</div>
									@if(session("coupon_id"))
										<div  ><p class="your-order-f18">Giảm giá:</p></div>
										<div  ><h5 class="color-black">{{number_format(session("coupon_number"),0,"",".")}} <u>đ</u></h5></div>
									@endif
									<div ><p class="your-order-f18">Phí vận chuyển:</p></div>
									<div ><h5 class="color-black">{{number_format($fee,0,"",".")}} <u>đ</u></h5></div>
									<div ><p class="your-order-f18">Thành tiền:</p></div>
									<div><h5 class="color-black">{{number_format($total_price_final,0,"",".")}} <u>đ</u></h5></div>

									<div class="clearfix"></div>

				</div>

				<div class="clearfix"></div>
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->