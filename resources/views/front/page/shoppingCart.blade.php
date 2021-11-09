@extends("front.layout.index")

@section("content")

	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Giỏ hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="">Trang chủ</a> / <span>Giỏ hàng</span>
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
							<th class="product-name">Tên bánh</th>
							<th class="product-price">Giá</th>
							<th class="product-quantity">Số lượng</th>
							<th class="product-subtotal">Tổng giá</th>
							<th class="product-remove">Xóa</th>
						</tr>
					</thead>

			<form>
					@foreach(Cart::content() as $c)
					@if($product[$c->id]->quantity_stock>0)
					<tbody>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img  class="pull-left copingMiniImg" src="image/product/{{$c->options->img}}" alt="">
									<div class="media-body">
										<p class="font-large table-title">{{$c->name}}</p>
									</div>
								</div>
							</td>
							<td class="product-price">
								<span class="amount">{{number_format($c->price,0,"",".")}} <u>đ</u></span>
							</td>
							<!--Update all cart-->
							@csrf
							<input type="hidden" class="quantity_stock_{{$c->rowId}}" value="{{$product[$c->id]->quantity_stock}}">
							<td class="product-quantity">
								  <input type="number" value="{{$c->qty}}" data-row_id="{{$c->rowId}}" class="check_qty" id="quantity" name="quantity" min="1" max="5">
							</td>
							<!---->

						</td>
							<td class="product-subtotal">
								<span class="amount">{{number_format($c->qty * $c->price)}} <u>đ</u></span>
							</td>

							<td class="product-remove">
								<a href="deltocart/{{$c->rowId}}" class="remove" title="Xóa bánh" ><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					</tbody>
					@endif
					@endforeach

					<tfoot>
						<tr>
								@if(Cart::count()>0)
							<td colspan="6" class="actions">
			</form>
								<form action="delallcart" method="post">
									@csrf
									<button type="submit"  class="beta-btn primary">Xóa giỏ hàng<i class="fa fa-chevron-right"></i></button><br>
								</form>
									<label for="coupon_code"></label>
								<div class="coupon">
								<form action="applyCoupon" method="post">
									@csrf
									<input type="text" name="code"  placeholder="Mã giảm giá">
									<button type="submit" class="beta-btn primary">Áp dụng <i class="fa fa-chevron-right"></i></button>
								</form>
								@endif
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
				<!-- End of Shop Table Products -->
			</div>


			<!-- Cart Collaterals -->
			<div class="cart-collaterals">
				<div class="cart-totals pull-right">
				<!--	<div class="cart-totals-row"><span>Cart Subtotal:</span> <span>$188.00</span></div>
					<div class="cart-totals-row"><span>Shipping:</span> <span>Free Shipping</span></div>-->
					<div class="cart-totals-row"><h5 class="cart-total-title">Tổng giỏ hàng</h5></div>
					<div class="cart-totals-row"><span>Tạm tính:</span> <span>{{Cart::priceTotal(0,"",".")}} <u>đ</u></span></div>
					@if(session("coupon_number"))
						<div class="cart-totals-row"><span>Giảm giá:</span> <span>{{number_format(session("coupon_number"),0,"",".")}} <u>đ</u></span></div>
						<div class="cart-totals-row"><span>Thành tiền:</span> <span>{{number_format(session("priceTotalAfterApply"),0,"",".")}} <u>đ</u></span></div>
					@else
						<div class="cart-totals-row"><span>Thành tiền:</span> <span>{{Cart::priceTotal(0,"",".")}} <u>đ</u></span></div>
					@endif

					<a class="beta-btn primary order" href="checkoutaddress" name="proceed">tiến hành đặt hàng <i class="fa fa-chevron-right"></i></a>

				</div>

				<div class="clearfix"></div>
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection

@section("script")
<script type="text/javascript">
	$(document).ready(function($){
		$(document).on("blur",".check_qty",function(){
			var qty=$(this).val();
			var rowId=$(this).data("row_id");
			var qty_stock=$(".quantity_stock_"+rowId).val();
    		var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"updateallcart",
				method:"post",
				data:{qty:qty,rowId:rowId,_token:_token},
				success:function(data)
				{
					if(parseInt(data)<=parseInt(qty_stock))
                	{
						swal({
	                              title: "Số lượng bánh này chỉ còn "+data+" bánh",
  								  type: "warning",
								  confirmButtonClass: "btn-warning",
	                              confirmButtonText: "Xem tiếp",
								  closeOnConfirm: false
								},
								function() {
									$(this).val(qty_stock);
                					location.reload();
	                            });
                	}else
                		location.reload();

				}
			});
		});
	});
</script>
@endsection
