<?php $__env->startSection("content"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Hết</small>
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
                                <th>Số lượng trong kho</th>
                                <th>Số lượng đã bán</th>
                                <th>Tên</th>
                                <th>Loại sản phẩm</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $outOfStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($p->quantity_stock); ?></td>
                                <td><?php echo e($p->quantity_sold); ?></td>
                                <td>
                                    <?php echo e($p->name); ?><br>
                                    <img width="100px" src="image/product/<?php echo e($p->img); ?>">
                                </td>
                                <td><?php echo e($p->type_product->name); ?></td>
                                <td><?php echo e(number_format($p->unit_price,0,"",".")); ?> <u>đ</u></td>
                                <?php if($p->promotion_price): ?>
                                <td><?php echo e(number_format($p->promotion_price,0,"",".")); ?> <u>đ</u></td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>
                </div>


                 
            </div>
            <!-- /.container-fluid -->
        </div>

<?php $__env->stopSection(); ?>

                <!-- /.row -->
<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/statistical/outOfStock.blade.php ENDPATH**/ ?>