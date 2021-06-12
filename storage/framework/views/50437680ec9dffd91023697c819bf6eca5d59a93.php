

<?php $__env->startSection("content"); ?>
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Tìm thấy <?php echo e(count($prod)); ?> bánh</h4>
							<div class="beta-products-details">
								<p class="pull-left"></p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								<?php $__currentLoopData = $prod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($p->active==1): ?>
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale"><?php if($p->promotion_price): ?><?php echo e("Khuyến mãi"); ?><?php endif; ?></div></div>
										<div class="single-item-header">
											<a href="detailproduct/<?php echo e($p->id); ?>"><img src="image/product/<?php echo e($p->img); ?>" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><?php echo e($p->name); ?></p>
											<p class="single-item-price">
												<?php if($p->promotion_price): ?>
												<span class="flash-del"><?php echo e(number_format($p->unit_price,0,"",".")); ?> <u>đ</u></span>
												<span class="flash-sale"><?php echo e(number_format($p->promotion_price,0,"",".")); ?> <u>đ</u></span>
												<?php else: ?>
												<span class="flash-sale"><?php echo e(number_format($p->unit_price,0,"",".")); ?> <u>đ</u></span>
												<?php endif; ?>
											</p>
											<br>
										</div>
										<div class="single-item-caption">
											<?php if($p->quantity_stock>0): ?>
											<form>
                                                <?php echo csrf_field(); ?>
                                           		<input type="hidden" value="1" class="qty_<?php echo e($p->id); ?>">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="<?php echo e($p->id); ?>" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/<?php echo e($p->id); ?>l">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
											<?php else: ?>
											<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
											<?php endif; ?>
										</div>
										<br>
									</div>
								</div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/page/search.blade.php ENDPATH**/ ?>