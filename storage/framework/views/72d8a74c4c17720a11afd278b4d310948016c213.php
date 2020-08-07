
<?php $__env->startSection("content"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">Trạng thái hóa đơn
                            <small><?php switch($bill->active):
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
                                </small>
                        </h1>                       
                         <h1 class="page-header">Chi tiết hóa đơn
                            <small>Thông tin vận chuyển</small>
                        </h1>

                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên khách hàng</th>
                                <th>E-mail</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Cách thức thanh toán</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($bill->user->id); ?></td>
                                <td><?php echo e($bill->user->name); ?></td>
                                <td><?php echo e($bill->user->email); ?></td>
                                <td><?php echo e($bill->user->phone_number); ?></td>
                                <?php if($bill->user->id_city && $bill->user->id_district && $bill->user->id_ward): ?>
                                <td><?php echo $bill->user->address.", ".$bill->user->ward->name.", ".$bill->user->district->name.", ".$bill->user->city->name;?></td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <td><?php echo e($bill->payment); ?></td>
                                <td><?php echo e($bill->note); ?></td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết hóa đơn
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng trong kho</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng mua</th>
                                <th>Tổng tiền</th>
                                <th>Mã giảm giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bill->bill_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($d->id); ?></td>
                                <td><?php echo e($d->product->name); ?></td>
                                <td><?php echo e($d->product->quantity_stock); ?></td>
                                <td><?php echo e(number_format($d->product->unit_price)); ?> VND</td>
                                <?php if($d->product->promotion_price): ?>
                                <td><?php echo e(number_format($d->product->promotion_price)); ?> VND</td>
                                <td><?php echo e($d->quantity); ?></td>
                                <td><?php echo e(number_format($d->product->promotion_price*$d->quantity)); ?> VND</td>
                                <?php else: ?>
                                <td></td>
                                <td><?php echo e($d->quantity); ?></td>
                                <td><?php echo e(number_format($d->product->unit_price*$d->quantity)); ?> VND</td>
                                <?php endif; ?>
                                 <?php if($bill->id_coupon): ?>
                                <td><?php echo e($bill->coupon->name); ?></td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>
                                <strong><mark>Tạm tính: <?php echo e(number_format($bill->total_price_first)); ?> VND<br>
                                <?php if($bill->id_coupon): ?>
                                Phí giảm giá: <?php if($bill->coupon->number<=100): ?><?php echo e(number_format(($bill->coupon->number*$bill->total_price_first)/100)); ?><?php else: ?><?php echo e(number_format($bill->coupon->number)); ?><?php endif; ?> VND<br>
                                <?php endif; ?>
                                Phí vận chuyển: <?php echo e(number_format($bill->feeship)); ?> VND<br>
                                Thành tiền: <?php echo e(number_format($bill->total_price_final)); ?> VND<br>
                                </mark><strong>
                            <div class="col-lg-12">
                                <h1><a target="_blank" href="prinfBillDetail/<?php echo e($bill->id); ?>">In đơn hàng</a></h1>
                            </div>

                                        

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<?php $__env->stopSection(); ?>
                               

<?php echo $__env->make("admin.layout.index", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/LaravelSell/resources/views/admin/bill_detail/list.blade.php ENDPATH**/ ?>