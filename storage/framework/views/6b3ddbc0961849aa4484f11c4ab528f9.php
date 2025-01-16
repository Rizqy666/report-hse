<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Data Report')); ?></div>
                    <div class="card-body">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" action="<?php echo e(route('hse_report.index')); ?>"
                                        class="p-3 rounded shadow-sm border bg-light">
                                        <h5 class="text-primary mb-3">Filter Reports</h5>

                                        <!-- Filter Tanggal -->
                                        <div class="form-group mb-3">
                                            <label for="date-range" class="form-label">Date Range</label>
                                            <div class="input-group">
                                                <input type="date" name="start_date" class="form-control" id="start_date"
                                                    value="<?php echo e(request('start_date')); ?>">
                                                <span class="input-group-text">to</span>
                                                <input type="date" name="end_date" class="form-control" id="end_date"
                                                    value="<?php echo e(request('end_date')); ?>">
                                            </div>
                                        </div>

                                        <!-- Filter Pelapor -->
                                        <div class="form-group mb-3">
                                            <label for="reported_by" class="form-label">Reported By</label>
                                            <div class="input-group">
                                                <select name="reported_by" class="form-control" id="reported_by">
                                                    <option value="">All Reporters</option>
                                                    <?php $__currentLoopData = $reporters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($reporter); ?>"
                                                            <?php echo e(request('reported_by') == $reporter ? 'selected' : ''); ?>>
                                                            <?php echo e($reporter); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Filter Status -->
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <div class="input-group">
                                                <select name="status" class="form-control" id="status">
                                                    <option value="">All Status</option>
                                                    <option value="approve"
                                                        <?php echo e(request('status') == 'approve' ? 'selected' : ''); ?>>Approve
                                                    </option>
                                                    <option value="reject"
                                                        <?php echo e(request('status') == 'reject' ? 'selected' : ''); ?>>Reject
                                                    </option>
                                                    <option value="not_accept"
                                                        <?php echo e(request('status') == 'not_accept' ? 'selected' : ''); ?>>Not Accept
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Tombol Filter -->
                                        <button class="btn btn-primary mt-2" type="submit">
                                            <i class="fa fa-filter"></i> Apply Filters
                                        </button>
                                    </form>
                                </div>


                            </div>
                        </div>
                        <span>Jumlah Laporan:
                            <?php echo e($reports->isNotEmpty() ? $reports->count() : 'Tidak tersedia'); ?> data</span>
                        <table id="example" class="table table-striped table-bordered shadow-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->reported_by); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($item->date)->format('d-M-Y')); ?></td>
                                        <td><?php echo e($item->inst_dept); ?></td>
                                        <td>
                                            <?php
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
                                            <div class="d-flex justify-content-center w-full">
                                                <a href="<?php echo e(route('hse_report.show', $item->id)); ?>"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa-solid fa-eye"></i> Show
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($reports->onEachSide(1)->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report-hse-feature-baru\resources\views/report/data.blade.php ENDPATH**/ ?>