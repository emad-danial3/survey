<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.statistics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.statistics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="box">

        <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.statistics')); ?></h3>
        </div>
        <div class="box-body">
            <?php if(count($surveys)): ?>
                <div class="box">

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">


                                        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(url('admin/getUserStatistic')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden"  name="user_id" id="user_id" value="<?php echo e($user->id); ?>">
                                            <input type="hidden"  name="location_id" id="location_id" value="<?php echo e($user->location_id); ?>">
                                            <div class="form-group">

                                                <select class="form-control select2" id="page_id" required
                                                        name="page_id">
                                                    <option value=""><?php echo e(trans('admin.pages')); ?></option>
                                                    <?php $__currentLoopData = $surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            value="<?php echo e($survey->id); ?>"  <?php if($lastSurveyId == $survey->id): ?> selected <?php endif; ?>  >
                                                            <?php echo e($survey->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        <button type="submit" class="btn btn-primary ">Search</button>

                                        </form>
                                    </div>
<br>
<br>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th><?php echo e(trans('admin.title')); ?></th>

                                                <th><?php echo e(trans('admin.status')); ?></th>

                                                <th><?php echo e(trans('datatable.show')); ?></th>

                                            </tr>
                                            </thead>
                                            <tbody>


















                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                
            <?php else: ?>
                <div class="alert alert-danger">
                    No Data
                </div>
            <?php endif; ?>
        </div>

    </div>

    <?php $__env->startPush('js'); ?>

        <script type="text/javascript">
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
            $(document).ready(function () {
                $('.select5').select2();
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/users/surveys.blade.php ENDPATH**/ ?>