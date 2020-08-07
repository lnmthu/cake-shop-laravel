

<?php $__env->startSection("content"); ?>
	<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="home">Trang chủ</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->
	
	<div class="container">
		<div id="content">
			
			<form action="login" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Form Đăng nhập</h4>
						<div class="space20">&nbsp;</div>
						<?php if(session("thongbao")): ?>
							<div class="alert alert-danger"><?php echo e(session("thongbao")); ?></div>
						<?php endif; ?>
						<?php if(count($errors)>0): ?>
                    		<div class="alert alert-danger"> 
                    			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $er): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    				<?php echo e($er); ?><br>
                    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    		</div>
                    	<?php endif; ?>
						<div class="form-block">
							<label for="email">E-mail*</label>
							<input name="email" type="email" id="email" placeholder="Nhập email" required>
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu*</label>
							<input name="password" type="password" id="phone" placeholder="Nhập mật khẩu" required>
						</div>
						<!-- ReCaptcha -->
						<div class="g-recaptcha" data-sitekey="<?php echo e(env('CAPTCHA_KEY')); ?>"></div>
						<br/>
						
						<!-- /ReCaptcha -->


						<div class="form-block">
							<button  type="submit" class="btn btn-primary">Đăng nhập</button>
						</div>
						<a href="loginfacebook">Đăng nhập bằng Facebook </a><br>
						<a href="logingoogle">Đăng nhập bằng Google </a>

					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/page/login.blade.php ENDPATH**/ ?>