
<?php $__env->startSection("content"); ?>
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	 <?php if(count($errors)>0): ?>
                        <div class="alert alert-danger"> 
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $er): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($er); ?><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    	<?php if(session("loi")): ?>
                    		<div class="alert alert-danger">
                    			<?php echo e(session("loi")); ?><br>
                    		</div>
                    	<?php endif; ?>
                    	<?php if(session("thongbao")): ?>
                    		<div class="alert alert-success">
                    			<?php echo e(session("thongbao")); ?><br>
                    		</div>
                    	<?php endif; ?>
                       <form action="admin/typeProduct/add" method="POST" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên loại sản phẩm" placeholder="Nhập tên" />
                            </div>
                             <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor" name="description" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <br>                       
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/type_product/add.blade.php ENDPATH**/ ?>