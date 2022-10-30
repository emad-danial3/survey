<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.pageShow')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.pages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border text-center">
                  <h3 class="box-title"><?php echo e($model->name); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">

                        <?php if($page_question): ?>
                            <?php $__currentLoopData = $page_question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8" style="text-align: center;border-radius: 7px;background-color: rgb(123, 55, 10); color: rgba(255, 255, 255, 1);padding: 12px 24px;">
                                        <h3 class="box-title"><?php echo e($category['category']['name']); ?></h3>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <?php if($category['category']['questions'] && count($category['category']['questions'])>0): ?>
                                    <?php $__currentLoopData = $category['category']['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-8" style="border: 1px solid #ddd;border-radius: 15px;margin-bottom: 30px;">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" colspan="5"> <?php echo $question['title']; ?> </th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" > </th>
                                                        <?php if($question_options && count($question_options)>0): ?>
                                                            <th scope="col"><?php echo e($question_options['option_1']); ?></th>
                                                            <th scope="col"><?php echo e($question_options['option_2']); ?></th>
                                                            <th scope="col"><?php echo e($question_options['option_3']); ?></th>
                                                            <th scope="col"><?php echo e($question_options['option_4']); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php if($category['users'] && count($category['users'])>0): ?>
                                                        <?php $__currentLoopData = $category['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $induser=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <th scope="row" style="max-width: 350px;width: 350px;overflow: hidden"><?php echo e($user['user']['name']); ?></th>
                                                                <td><input type="radio"  name="option" value="جيد">  </td>
                                                                <td><input type="radio"  name="option" value="متوسط">  </td>
                                                                <td><input type="radio"  name="option" value="ضعيف">  </td>
                                                                <td><input type="radio"  name="option" value="N/A"> </td>
                                                            </tr>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                            </div>



                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/pages/show.blade.php ENDPATH**/ ?>