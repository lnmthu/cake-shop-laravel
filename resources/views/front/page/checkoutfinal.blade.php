@extends("front.layout.index")

@section("content")
<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->

	<div class="container">
		<div id="content">

			<form action="checkoutfinal" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					@if(count($errors)>0)
                    		<div class="alert alert-danger">
                    			@foreach($errors->all() as $er)
                    				{{$er}}<br>
                    			@endforeach
                    		</div>
                    	@endif
                    	@if(session("thongbao"))
                    		<div class="alert alert-success">
                                 {!! session("thongbao")  !!}
                                <br>
                    		</div>
                    	@endif
					<!-- <div class="col-sm-6">
						@if(Auth::check())
						<h4>Form Thông tin</h4>
						<div class="space20">&nbsp;</div>
						@if(count($errors)>0)
                    		<div class="alert alert-danger">
                    			@foreach($errors->all() as $er)
                    				{{$er}}<br>
                    			@endforeach
                    		</div>
                    	@endif
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
						<div class="form-block">
							<label for="email">Email*</label>
							<input  type="email" id="email" name="email" value="{{Auth::user()->email}}" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Họ tên*</label>
							<input type="text" id="your_last_name" name="name" value="{{Auth::user()->name}}" placeholder="Nhập họ tên" required>
						</div>
						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" value="{{Auth::user()->address}}" placeholder="Nhập địa chỉ" required>
						</div>
						<div class="form-block">
							<label for="phone">Số điên thoại*</label>
							<input type="text" id="phone" name="phone_number" value="{{Auth::user()->phone_number}}" placeholder="Nhập số điện thoại" required>
						</div>
						<div class="form-block">
						<label for="gender">Giới tính*</label>
                                  <input id="gender" @if(Auth::user()->gender==1){{"checked"}}@endif name="gender" value="1" type="radio"class="input-radio" style="width: 5%"><span style="margin-right: 10%">Nam</span>
                                   <input @if(Auth::user()->gender==2){{"checked"}}@endif id="gender" name="gender" value="2" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Nữ</span>
                                   <input @if(Auth::user()->gender==3){{"checked"}}@endif id="gender" name="gender" value="3" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Khác</span>
						</div>
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="note" value="Auth::user()->note" placeholder="Nhập ghi chú"></textarea>
						</div>
						@endif
					</div> -->
							@if(Cart::count()>0)
					<div class="col-sm-6 ">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>

							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
								@foreach(cart::content() as $c)
									<!--  one item	 -->
										<div class="media">
											<img width="25%" src="image/product/{{$c->options->img}}" alt="" class="pull-left">

											<div class="media-body">
												<p class="font-large">{{$c->name}}</p>
												<span class="flash-sale" class="color-gray your-order-info">{{$c->qty}}*<span>{{number_format($c->price,0,"",".")}}</span></span>
											</div>
										</div>
									<!-- end one item -->
									@endforeach
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
										<div  ><p class="your-order-f18">Tạm tính:</p></div>
										<div  ><h5 class="color-black">{{Cart::priceTotal(0,"",".")}} <u>đ</u></h5></div>
								</div>
									@if(session("coupon_id"))
										<div  ><p class="your-order-f18">Giảm giá:</p></div>
										<div  ><h5 class="color-black">{{number_format(session("coupon_number"),0,"",".")}} <u>đ</u></h5></div>
										<input type="hidden" name="id_coupon" value="{{session('coupon_id')}}">
									@endif
									<div ><p class="your-order-f18">Phí vận chuyển:</p></div>
									<div ><h5 class="color-black">{{number_format($fee,0,"",".")}} <u>đ</u></h5></div>
									<input type="hidden" name="feeship" value="{{$fee}}">
									<div ><p class="your-order-f18">Thành tiền:</p></div>
									<div><h5 class="color-black">{{number_format($total_price_final,0,"",".")}} <u>đ</u></h5></div>
									<input type="hidden" name="total_price_final" value="{{$total_price_final}}">

									<div class="clearfix"></div>
							</div>

							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											<?php $user=Auth::user();?>
											Cửa hàng sẽ gửi hàng đến địa chỉ: <?php echo $user->address.", ".$user->ward->name.", ".$user->district->name.", ".$user->city->name;?>. Bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>+ Số tài khoản: 123 456 789
											<br>+ Chủ TK: Nguyễn A
											<br>+ Ngân hàng ACB, Chi nhánh TPHCM<br>
											Cửa hàng sẽ gửi hàng đến địa chỉ: <?php echo $user->address.", ".$user->ward->name.", ".$user->district->name.", ".$user->city->name;?>
										</div>
									</li>

								</ul>

							</div>
							<div class="your-order-head"><h5>Ghi chú</h5></div>
									<textarea style="width: 550px" id="notes" name="note" placeholder="Điền thôn tin ghi chú đơn hàng"></textarea>
									<br><br>
							<div class="text-center"><button class="beta-btn primary order" type="submit" >đặt hàng <i class="fa fa-chevron-right"></i></button></div>
							@endif

							</div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
