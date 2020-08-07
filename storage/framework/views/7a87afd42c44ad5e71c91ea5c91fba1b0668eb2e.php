
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href="contact"><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
						<li><a href="contact"><i class="fa fa-phone"></i> 0163 296 7751</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						<?php if(Auth::check()): ?>
						<li><a href="infor"><i class="fa fa-user"></i><?php echo e(Auth::user()->name); ?></a></li>
						<li><a href="logout">Đăng xuất</a></li>
						<?php else: ?>
						<li><a href="signup">Đăng kí</a></li>
						<li><a href="login">Đăng nhập</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="home" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="search">
					        <input type="text" value="" name="search" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					<div class="beta-comp">
							<div class="cart">
								<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (<?php if(Cart::count()>0): ?><?php echo e(Cart::count()." Bánh"); ?><?php else: ?><?php echo e("Trống"); ?><?php endif; ?>)</div>
								<!-- <div class="beta-dropdown cart-body">
									<?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="cart-item">
										<div class="media">
											<a class="pull-left" href="detailproduct/<?php echo e($c->id); ?>"><img src="image/product/<?php echo e($c->options->img); ?>" alt=""></a>
											<div class="media-body">
												<span class="cart-item-title"><?php echo e($c->name); ?></span>
												<span class="cart-item-amount"><?php echo e($c->qty); ?>*<span><?php echo e($c->price); ?></span></span>
											</div>
										</div>
									</div>		
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				

									<div class="cart-caption">
										<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"><?php echo e(Cart::priceTotal(0)); ?> VND</span></div>
										<div class="clearfix"></div>

										<div class="center">
											<div class="space10">&nbsp;</div>
											<a href="shoppingCart" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
										</div>
									</div>
								</div> -->
							</div> <!-- .cart -->
					</div>

				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="home">Trang chủ</a></li>
						<li><a>Loại bánh</a>
							<ul class="sub-menu">
								<?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="product/<?php echo e($t->id); ?>"><?php echo e($t->name); ?></a></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</li>
						<li><a href="shoppingCart">Giỏ hàng</a></li>
						<li><a href="about">Giới thiệu</a></li>
						<li><a href="contact">Liên hệ</a></li>
						<?php if(Auth::check()): ?>
						<li><a>Tài khoản</a>
							<ul class="sub-menu">
								<li><a href="infor">Thông tin</a></li>
								<li><a href="managebill">Quản lý đơn hàng</a></li>
							</ul>
						</li>
						<?php endif; ?>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header --><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/layout/header.blade.php ENDPATH**/ ?>