<?php $__env->startSection('page_title'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>

    <?php echo e(trans('admin.Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- ./col -->

















                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($categoriesCount); ?></h3>

                            <p><?php echo e(trans('admin.categories')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-albums-outline"></i>
                        </div>
                        <a href="<?php echo e(url('admin/categories')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e($questionsCount); ?></h3>

                            <p><?php echo e(trans('admin.questions')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="<?php echo e(url('admin/questions')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>

                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo e($userCount); ?></h3>


                            <p><?php echo e(trans('admin.users')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="<?php echo e(url('admin/users')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?php echo e($departmentsCount); ?></h3>


                            <p><?php echo e(trans('admin.departments')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="<?php echo e(url('admin/departments')); ?>" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> <?php echo e(trans('admin.More Info')); ?> </a>
                    </div>
                </div>
                <!-- ./col -->


            </div>
            <div class="row">


                <div class="col-lg-3 col-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-paper-plane"></i></span>

                        <div class="info-box-content">
                            <h3 class="info-box-text" style="margin-top: 5px; "><?php echo e(trans('admin.pages')); ?></h3>
                            <span class="info-box-number"><?php echo e($surveyCount); ?></span>
                            <a href="<?php echo e(url('admin/pages')); ?>">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


            </div>

        </div><!-- /.container-fluid -->
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/oso/Desktop/survey/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>