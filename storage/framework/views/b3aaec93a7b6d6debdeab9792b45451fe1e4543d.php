
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.reports')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.reports')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="message-flash">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
           

            <div class="table-responsive">
                <?php echo $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap' , 'id' => 'datatable5'], true); ?>

            </div>
        </div>
    </div>

    <style>
        .dataTables_filter {
            float: left;
        }
    </style>
    <?php $__env->startPush('js'); ?>

        <?php echo $dataTable->scripts(); ?>

        <script type="text/javascript">
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
            $(document).ready(function () {
                $('.select5').select2();
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\eva\survey\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>