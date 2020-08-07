
<?php $__env->startSection("content"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->


                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                         <?php if(session("thongbao")): ?>
                            <div class="alert alert-success">
                                <?php echo e(session("thongbao")); ?><br>
                            </div>
                        <?php endif; ?>
                         <?php if(session("loi")): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session("loi")); ?><br>
                            </div>
                        <?php endif; ?>
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $typeProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($type->id); ?></td>
                                <td>
                                    <?php echo e($type->name); ?><br>
                                </td>
                                <td><?php echo e($type->description); ?></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/typeProduct/delete/<?php echo e($type->id); ?>">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/typeProduct/edit/<?php echo e($type->id); ?>">Sửa</a></td>
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
<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/type_product/list.blade.php ENDPATH**/ ?>