
<?php $__env->startSection("content"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                                <th>Quyền</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Tỉnh/Thành phố</th>
                                <th>Quận/Huyện</th>
                                <th>Xã/Phường/Thị trấn</th>
                                <th>Địa chỉ</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($u->id); ?></td>
                                <?php if($u->quyen==0): ?>
                                    <td>Thường</td>
                                <?php else: ?>
                                    <td>Admin</td>
                                <?php endif; ?>
                                <td><?php echo e($u->name); ?></td>
                                <td><?php echo e($u->email); ?></td>
                                <?php if($u->gender==1): ?>
                                    <td>Nam</td>
                                <?php elseif($u->gender==2): ?>
                                    <td>Nữ</td>
                                <?php elseif($u->gender==3): ?>
                                    <td>Khác</td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>    
                                <td><?php echo e($u->phone_number); ?></td>
                                <?php if($u->city&&$u->district&&$u->ward): ?> 
                                <td><?php echo e($u->city->name); ?></td>
                                <td><?php echo e($u->district->name); ?></td>
                                <td><?php echo e($u->ward->name); ?></td>
                                <?php else: ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <?php endif; ?>
                                <td><?php echo e($u->address); ?></td>
                                <td class="center">
                                    <form action="admin/users/<?php echo e($u->id); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" ><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>
                               
                                <td class="center"><a href="admin/users/<?php echo e($u->id); ?>/edit"><i class="fa fa-pencil fa-fw"></i></a></td>
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
<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/users/list.blade.php ENDPATH**/ ?>