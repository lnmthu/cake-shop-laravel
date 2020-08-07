

<?php $__env->startSection("content"); ?>

	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Giỏ hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="home">Trang chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->
						
	<div class="container">
		<div id="content">
			<div class="table-responsive">
						<?php if(session("thongbao")): ?>
							<div class="alert alert-success"><?php echo e(session("thongbao")); ?></div>
							<?php session()->forget("thongbao");?>
						<?php endif; ?>
						<?php if(session("loi")): ?>
							<div class="alert alert-danger"><?php echo e(session("loi")); ?></div>
							<?php session()->forget("loi");?>
						<?php endif; ?>
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
					<?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($product[$c->id]->quantity_stock>0): ?>
					<tbody>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img width="100px" class="pull-left" src="image/product/<?php echo e($c->options->img); ?>" alt="">
									<div class="media-body">
										<p class="font-large table-title"><?php echo e($c->name); ?></p>
									</div>
								</div>
							</td>
							<td class="product-price">
								<span class="amount"><?php echo e(number_format($c->price,0,"",".")); ?> <u>đ</u></span>
							</td>
							<!--Update all cart-->
							<?php echo csrf_field(); ?>
							<input type="hidden" class="quantity_stock_<?php echo e($c->rowId); ?>" value="<?php echo e($product[$c->id]->quantity_stock); ?>">		
							<td class="product-quantity">
								  <input type="number" value="<?php echo e($c->qty); ?>" data-row_id="<?php echo e($c->rowId); ?>" class="check_qty" id="quantity" name="quantity" min="1" max="5">
							</td>
							<!---->

						</td>
							<td class="product-subtotal">
								<span class="amount"><?php echo e(number_format($c->qty * $c->price)); ?> <u>đ</u></span>
							</td>

							<td class="product-remove">
								<a href="deltocart/<?php echo e($c->rowId); ?>" class="remove" title="Xóa bánh" ><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					</tbody>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
					<tfoot>
						<tr>
								<?php if(Cart::count()>0): ?>
							<td colspan="6" class="actions">
			</form>
								<form action="delallcart" method="post">
									<?php echo csrf_field(); ?>
									<button type="submit"  class="beta-btn primary">Xóa giỏ hàng<i class="fa fa-chevron-right"></i></button><br>
								</form>
									<label for="coupon_code"></label> 
								<div class="coupon">
								<form action="applyCoupon" method="post">
									<?php echo csrf_field(); ?>
									<input type="text" name="code"  placeholder="Mã giảm giá"> 
									<button type="submit" class="beta-btn primary">Áp dụng mã giảm giá<i class="fa fa-chevron-right"></i></button>
								</form>
								<?php endif; ?>
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
					<div class="cart-totals-row"><span>Tạm tính:</span> <span><?php echo e(Cart::priceTotal(0,"",".")); ?> <u>đ</u></span></div>
					<?php if(session("coupon_number")): ?>
						<div class="cart-totals-row"><span>Giảm giá:</span> <span><?php echo e(number_format(session("coupon_number"),0,"",".")); ?> <u>đ</u></span></div>
						<div class="cart-totals-row"><span>Thành tiền:</span> <span><?php echo e(number_format(session("priceTotalAfterApply"),0,"",".")); ?> <u>đ</u></span></div>
					<?php else: ?>
						<div class="cart-totals-row"><span>Thành tiền:</span> <span><?php echo e(Cart::priceTotal(0,"",".")); ?> <u>đ</u></span></div>
					<?php endif; ?>

					<a class="beta-btn primary" href="checkoutaddress" name="proceed">Đặt hàng <i class="fa fa-chevron-right"></i></a>

				</div>

				<div class="clearfix"></div>
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/page/shoppingCart.blade.php ENDPATH**/ ?>