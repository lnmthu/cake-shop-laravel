

<?php $__env->startSection("content"); ?>
<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Xác nhận thông tin</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="home">Trang chủ</a> / <span>Xác nhận thông tin</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->
	
	<div class="container" >
		<div id="content">
			
			<form action="checkoutaddress" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				<div class="row">
					<div class="col-sm-6">
						
						<?php if(Auth::check()): ?>
						<h4>Thông tin giao hàng</h4>
						<div class="space20">&nbsp;</div>
						<?php if(count($errors)>0): ?>
                            <div class="alert alert-danger"> 
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $er): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($er); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
						<div class="form-block">
							<label for="email">Email*</label>
							<input  type="email" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Họ tên*</label>
							<input type="text" id="your_last_name" name="name" value="<?php echo e(Auth::user()->name); ?>" placeholder="Nhập họ tên" required>
						</div>
						 <div class="form-block">
                                <label>Tỉnh/Thành phố</label>
                                <?php $district=null;$ward=null;?>
                                <select name="id_city" id="city" class="form-control choose">
                                    	<option value=""> - - Chọn tỉnh thành phố - - </option>
                                    <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php
                                                    if(Auth::user()->id_city==$c->id) 
                                       				 {
                                       				 	echo "selected";
                                        				$district=$c->district; 
                                        			  }
                                        		?>
                                        			   value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                            <div class="form-block">
                                <label>Quận/Huyện</label>
                                <select name="id_district" id="district" class="form-control choose">
                                    <option value=""> - - Chọn quận huyện - - </option>
                                 <?php if($district): ?>
                                      <?php $__currentLoopData = $district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        								
                                            <option <?php if(Auth::user()->id_district==$d->id)
        									 $ward=$d->ward; echo "selected";?> value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>    
                            <div class="form-block">
                                <label>Phường/Xã/Thị trấn</label>
                                <select name="id_ward" id="ward" class="form-control">
                                    <option value=""> - - Chọn xã phường thị trận - - </option>
                                <?php if($ward): ?>
                                     <?php $__currentLoopData = $ward; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option
                                        <?php if(Auth::user()->id_ward==$w->id): ?> <?php echo e("selected"); ?> <?php endif; ?> value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php endif; ?>
                                </select>
                            </div>   

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" value="<?php echo e(Auth::user()->address); ?>" placeholder="Nhập địa chỉ" required>
						</div>
						<div class="form-block">
							<label for="phone">Số điên thoại*</label>
							<input type="text" id="phone" name="phone_number" value="<?php echo e(Auth::user()->phone_number); ?>" placeholder="Nhập số điện thoại" required>
						</div>
						<div class="form-block">
						<label for="gender">Giới tính*</label>
                                  <input id="gender" <?php if(Auth::user()->gender==1): ?><?php echo e("checked"); ?><?php endif; ?> name="gender" value="1" type="radio"class="input-radio" style="width: 5%"><span style="margin-right: 10%">Nam</span>
                                   <input <?php if(Auth::user()->gender==2): ?><?php echo e("checked"); ?><?php endif; ?> id="gender" name="gender" value="2" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Nữ</span>
                                   <input <?php if(Auth::user()->gender==3): ?><?php echo e("checked"); ?><?php endif; ?> id="gender" name="gender" value="3" type="radio"class="input-radio" style="width: 10%"><span style="margin-right: 5%">Khác</span>
						</div>
						
							<div class="text-center"><button class="beta-btn primary" type="submit" >Đặt hàng với thông tin này <i class="fa fa-chevron-right"></i></button></div>

						<?php endif; ?>
					</div>
					
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection("script"); ?>
<script type="text/javascript">
    $(document).ready(function($){
    	
      $(".choose").change(function(){
      	var action= $(this).attr("id");
         var id =$(this).val();
         var result="";
         var _token = $('input[name="_token"]').val();
         if(action=="city"){
         		result="district";
         }else{
         		result="ward";
         }
         $.ajax({
         		url:'<?php echo e(url('choose')); ?>',
         		method:"POST",
         		data:{action:action,id:id,_token:_token},
         		success:function(data){
         			 $("#"+result).html(data);
         		}

         });
      });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/front/page/checkoutaddress.blade.php ENDPATH**/ ?>