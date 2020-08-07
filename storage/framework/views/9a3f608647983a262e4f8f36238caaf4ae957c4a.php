
<?php $__env->startSection("content"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa đơn
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <?php if(session("thongbao")): ?>
                            <div class="alert alert-success">
                                <?php echo e(session("thongbao")); ?><br>
                            </div>
                        <?php endif; ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày mua</th>
                                <th>Trạng thái</th>
<!--                                 <th>Chuyển trạng thái</th>
 -->                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($b->id); ?></td>
                                <td><?php echo e($b->user->name); ?></td>
                                <td><?php echo e($b->date_order); ?></td>
                               
                                <td>
                                   <!--  <?php if($b->active==1): ?>
                                    <?php echo e("Đã xử lý"); ?>

                                    <?php else: ?>
                                    <?php echo e("Chưa xử lý"); ?>

                                    <?php endif; ?> -->
                                    <form>
                                        <?php echo csrf_field(); ?>
                                        <select <?php if($b->active==3): ?> <?php echo e("disabled"); ?><?php endif; ?> id="<?php echo e($b->id); ?>" name="active" class="form-control active">
                                      <option value=""> - - Chọn trạng thái - - </option>
                                    <?php for($i = 0; $i <=3; $i++): ?>
                                         <option <?php if($i==$b->active): ?> <?php echo e("selected"); ?> <?php endif; ?> value="<?php echo e($i); ?>"> 
                                        <?php switch($i):
                                            case (0): ?>
                                                <?php echo e("Đã tiếp nhận"); ?>

                                                <?php break; ?>
                                            <?php case (1): ?>
                                                <?php echo e("Đã xử lý"); ?>

                                            <?php break; ?>
                                            <?php case (2): ?>
                                                <?php echo e("Giao hàng thành công"); ?>

                                            <?php break; ?>
                                            <?php case (3): ?>
                                                <?php echo e("Đã hủy"); ?>

                                            <?php break; ?>
                                            <?php break; ?>
                                            <?php default: ?>
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                          </option>

                                    <?php endfor; ?>
                                           
                                </select>
                                    </form>
                                </td>
<!--                                 <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/bill/active/<?php echo e($b->id); ?>">Chuyển trạng thái</a></td>
 -->                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/billDetail/list/<?php echo e($b->id); ?>">Xem chi tiết</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("script"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change",".active",function(){
            var active=$(this).val();
            var id=$(this).attr("id");
            var _token=$("input[name='_token']").val();
            if(active==3)
            {
                $(this).attr("disabled","");
            }
            $.ajax({
                url:"admin/bill/active",
                method:"post",
                data:{active:active,id:id,_token:_token},
                success:function(data)
                {
                    location.reload(true);
                }

            });

        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/bill/list.blade.php ENDPATH**/ ?>