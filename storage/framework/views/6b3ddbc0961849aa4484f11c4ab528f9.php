<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo e(__('FORMULIR PEDULI HSE')); ?></div>
                    <div class="card-body">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" action="<?php echo e(route('hse_report.index')); ?>">
                                        <div class="input-group">
                                            <input type="date" name="start_date" class="form-control" required>
                                            <span class="input-group-text">to</span>
                                            <input type="date" name="end_date" class="form-control" required>
                                            <button class="btn btn-sm btn-primary" type="submit">Filtering</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <table id="example" class="table table-striped border-black" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Reporty By</th>
                                    <th>Tanggal</th>
                                    <th>Inst</th>
                                    <th>Status Kodindisi</th>
                                    <th>Status Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->reported_by); ?></td>
                                        <td><?php echo e($item->date); ?></td>
                                        <td><?php echo e($item->inst_dept); ?></td>
                                        <td>
                                            <?php
                                                // Mengubah string kembali menjadi array
                                                $condition_status = explode(', ', $item->condition_status);
                                            ?>

                                            <?php if(in_array('Unsafe Condition', $condition_status)): ?>
                                                <span class="badge bg-danger">Unsafe Condition</span>
                                            <?php endif; ?>
                                            <?php if(in_array('Unsafe Act', $condition_status)): ?>
                                                <span class="badge bg-warning">Unsafe Act</span>
                                            <?php endif; ?>
                                            <?php if(in_array('Safe Condition', $condition_status)): ?>
                                                <span class="badge bg-success">Safe Condition</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($item->feedback === 'reject'): ?>
                                                <span class="badge bg-danger">Reject</span>
                                            <?php elseif($item->feedback === 'approve'): ?>
                                                <span class="badge bg-success">Approve</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Not Accept</span>
                                            <?php endif; ?>
                                        </td>


                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('hse_report.show', $item->id)); ?>"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa-solid fa-eye"></i> Show
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Reporty By</th>
                                    <th>Tanggal</th>
                                    <th>Inst</th>
                                    <th>Status Kodindisi</th>
                                    <th>Status Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report-hse-feature-baru\resources\views/report/data.blade.php ENDPATH**/ ?>