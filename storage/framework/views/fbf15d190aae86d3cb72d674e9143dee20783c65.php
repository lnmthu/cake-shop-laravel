
<?php $__env->startSection("content"); ?>
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4><?php echo e($newproduct->first()->type_product->name); ?> mới</h4>
							<div class="beta-products-details">
								<p class="pull-left"><?php echo e(count($newproduct)); ?> bánh</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								<?php $__currentLoopData = $newproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($p->active==1): ?>
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale"><?php if($p->promotion_price): ?><?php echo e("Khuyến mãi"); ?><?php endif; ?></div></div>
										<div class="single-item-header">
											<a href="detailproduct/<?php echo e($p->id); ?>"><img width="500px" src="image/product/<?php echo e($p->img); ?>" alt=""></a>
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
										</div>
										<br>
										<?php if($p->quantity_stock>0): ?>
										<div class="single-item-caption">
											<form>
                                                <?php echo csrf_field(); ?>
                                           		<input type="hidden" value="1" class="qty_<?php echo e($p->id); ?>">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="<?php echo e($p->id); ?>" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/<?php echo e($p->id); ?>l">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<?php elseif($p->quantity_stock<=0): ?>
										<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
										<?php endif; ?>
										<br>
									</div>
								</div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<div class="row" style="text-align: center;"><?php echo e($newproduct->links()); ?></div>

							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4><?php echo e($topproduct->first()->type_product->name); ?> ngon</h4>
							<div class="beta-products-details">
								<p class="pull-left"><?php echo e(count($topproduct)); ?> bánh</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								<?php $__currentLoopData = $topproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($t->active==1): ?>								
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale"><?php if($t->promotion_price): ?><?php echo e("Khuyến mãi"); ?><?php endif; ?></div></div>

										<div class="single-item-header">
											<a href="detailproduct/<?php echo e($t->id); ?>"><img src="image/product/<?php echo e($t->img); ?>" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><?php echo e($t->name); ?></p>
											<p class="single-item-price">
												<?php if($t->promotion_price): ?>
												<span class="flash-del"><?php echo e(number_format($t->unit_price,0,"",".")); ?> <u>đ</u></span>
												<span class="flash-sale"><?php echo e(number_format($t->promotion_price,0,"",".")); ?> <u>đ</u></span>
												<?php else: ?>
												<span class="flash-sale"><?php echo e(number_format($t->unit_price,0,"",".")); ?> <u>đ</u></span>
												<?php endif; ?>
											</p>
										</div>
										<br>
										<?php if($t->quantity_stock>0): ?>
										<div class="single-item-caption quantity_stock">
											<form>
                                                <?php echo csrf_field(); ?>
                                           		<input type="hidden" value="1" class="qty_<?php echo e($t->id); ?>">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="<?php echo e($t->id); ?>" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/<?php echo e($t->id); ?>">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<?php elseif($t->quantity_stock<=0): ?>
										<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
										<?php endif; ?>
									</div>
									<br>
								</div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<br>
								<div class="row" style="text-align: center;"><?php echo e($topproduct->links()); ?></div>
								
							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/page/product.blade.php ENDPATH**/ ?>