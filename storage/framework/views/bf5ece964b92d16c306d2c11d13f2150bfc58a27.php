
<?php $__env->startSection("content"); ?>
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	<?php if(session("loi")): ?>
                    	<div class="alert alert-danger"><?php echo e(session("loi")); ?></div>
                    	<?php endif; ?>
                    	<?php if(session("thongbao")): ?>
                    	<div class="alert alert-success"><?php echo e(session("thongbao")); ?></div>
                    	<?php endif; ?>

                    <form action="admin/slide/add" method="post" enctype='multipart/form-data'>
                    	<?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên loại sản phẩm" placeholder="Nhập tên" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                               <input name="img" type="file"  
                                  data-validation="required"
                                  data-validation-error-msg-required="Làm ơn chọn hình ảnh">
                            </div>
                         <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <label class="radio-inline">
                                    <input checked="" name="active" value="0" type="radio">Không hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input name="active" value="1" type="radio">Hiển thị
                                </label>
                            </div>
                            
                            <br>                       
                            <input type="submit"  class="btn btn-default add_slide" value="Thêm">
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/slide/add.blade.php ENDPATH**/ ?>