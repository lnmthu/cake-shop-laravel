@extends("front.layout.index")

@section("content")
	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng ký thành viên</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="">Trang chủ</a> / <span>Đăng ký</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->

	<div class="container">
		<div id="content">

			<form action="signup" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4 style="text-align:center">Form Đăng ký</h4>
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
						<div class="form-block">
							<label for="email">Email*</label>
							<input  type="email" id="email" name="email" placeholder="Nhập email" required>
						</div>
						<div class="form-block">
							<label for="phone">Password*</label>
							<input  type="password" id="password" name="password" placeholder="Nhập password" required>
						</div>
						<div class="form-block">
							<label for="phone">Nhập lại password*</label>
							<input type="password" id="password" name="passwordAgain" placeholder="Nhập lại password" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Họ tên*</label>
							<input type="text" id="your_last_name" name="name" placeholder="Nhập họ tên" required>
						</div>
						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" placeholder="Nhập địa chỉ" required>
						</div>
						<div class="form-block">
							<label for="phone">Số điên thoại*</label>
							<input type="text" id="phone" name="phone_number" placeholder="Nhập số điện thoại"  required>
						</div>
						<div class="form-block">
						<label for="gender">Giới tính*</label>
                                  <input id="gender" checked="" name="gender" value="1"  type="radio"class="input-radio" style="width: 5%"><span style="margin-right: 10%">Nam</span>
                                   <input id="gender" name="gender" value="2" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Nữ</span>
                                   <input id="gender" name="gender" value="3" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Khác</span>
						</div>
						<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <div class="form-block">
                                <button  type="submit" class="btn btn-primary normal-signup">Đăng Ký</button>
                        </div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection
