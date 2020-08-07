
<?php $__env->startSection("content"); ?>
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                    	<?php if(session("thongbao")): ?>
                    		<div class="alert alert-success">
                    			<?php echo e(session("thongbao")); ?><br>
                    		</div>
                    	<?php endif; ?>
                       <form action="admin/users" method="POST">
                        	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="form-group">
                                <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                            </div>
                                <label>Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên" />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="email" placeholder="Nhập email" data-validation="email" data-validation-error-msg="Làm ơn nhập E-mail hợp lệ"/>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input  class="form-control" type="password" placeholder="Nhập mật khẩu" name="pass_confirmation"  data-validation="length" data-validation-length="min8" data-validation-error-msg="Làm ơn nhập mật khẩu ít nhất 8 kí tự"/>
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input  class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="pass" data-validation="confirmation" data-validation-error-msg="Làm ơn nhập lại mật khẩu khớp với mật khẩu ban đầu"/>
                            </div>
                            <input type="checkbox" name="changeOption" id="changeOption">Phần tùy chọn<br>
                            <div class="form-group">
                                <label>Số diện thoại</label>
                                <input disabled="" class="form-control option" name="phone_number" placeholder="Nhập số diện thoại" data-validation="number"  data-validation-error-msg="Làm ơn nhập số điện thoại"/>
                            </div>
                             <div class="form-block">
                                <label>Tỉnh/Thành phố</label>
                                <select data-validation="required"  data-validation-error-msg="Làm ơn chọn tỉnh thành phố" disabled="" name="id_city" id="city" class="form-control choose option">
                                        <option value=""> - - Chọn tỉnh thành phố - - </option>
                                    <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        </div> 
                        <div class="form-block">
                            <label>Quận/Huyện</label>
                            <select data-validation="required"  data-validation-error-msg="Làm ơn chọn quận huyện" disabled="" name="id_district" id="district" class="form-control choose option">
                                <option value=""> - - Chọn quận huyện - - </option>
                            </select>
                        </div>    
                        <div class="form-block">
                            <label>Phường/Xã/Thị trấn</label>
                            <select disabled="" name="id_ward" id="ward" class="form-control option" data-validation="required"  data-validation-error-msg="Làm ơn chọn xá phường thị trấn">
                                <option value=""> - - Chọn xã phường thị trận - - </option>
                            
                            </select>
                        </div>  
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input disabled="" class="form-control option" name="address" placeholder="Nhập địa chỉ" data-validation="required"  data-validation-error-msg="Làm ơn nhập địa chi"/>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea disabled=""  name="note" class="form-control option" rows="3"></textarea>
                            </div>  
                            <div class="form-group">
                                <label>Giới tính</label>
                                <label class="radio-inline">
                                    <input disabled="" id="option1" name="gender" value="1" checked="" type="radio">Nam
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" id="option2" name="gender" value="2" type="radio">Nữ
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" id="option3" name="gender" value="3" type="radio">Khác
                                </label>
                            </div>
                            <br>                       
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("script"); ?>
<script type="text/javascript">
    $(document).ready(function($){
        $("#changeOption").change(function(){
            if($(this).is(":checked")){
                $(".option").removeAttr("disabled");
                $("#option1").removeAttr("disabled");
                $("#option2").removeAttr("disabled");
                $("#option3").removeAttr("disabled");
            }
            else{
                $(".option").attr("disabled","");
                $("#option1").attr("disabled","");
                $("#option2").attr("disabled","");
                $("#option3").attr("disabled","");
            }

        });
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

<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/users/add.blade.php ENDPATH**/ ?>