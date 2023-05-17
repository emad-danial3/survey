<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.policies')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="message-flash">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-4">
                <a class="btn btn-success btn-md waves-effect waves-light mb-3"
                   href="<?php echo e(url('admin/policies/create')); ?>"
                   style="margin-bottom: 20px">
                    <i class="fa fa-plus-circle"></i> <?php echo e(trans('admin.policyCreate')); ?>

                </a>
            </div><!-- end col -->

            <div class="table-responsive">
                <?php echo $dataTable->table(['class' => 'dataTable table table-striped table-hover', 'id' => 'datatable_policy'], true); ?>

            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/oso/Desktop/survey/resources/views/admin/policies/index.blade.php ENDPATH**/ ?>