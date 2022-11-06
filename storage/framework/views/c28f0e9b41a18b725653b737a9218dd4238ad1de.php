
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

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">User LAST_NAME</th>
                    <th scope="col"><?php echo e($model->LAST_NAME); ?></th>
                </tr>
                <tr>
                    <th scope="col">User EMAIL ADDRESS</th>
                    <th scope="col"><?php echo e($model->EMAIL_ADDRESS); ?></th>
                </tr>
                <tr>
                    <th scope="col">User EMPLOYEE ID</th>
                    <th scope="col"><?php echo e($model->EMPLOYEE_ID); ?></th>
                </tr>
                <tr>
                    <th scope="col">Survey Title</th>
                    <th scope="col"><?php echo e($model->survey->name); ?></th>
                </tr>
                </thead>
            </table>

              <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="box-body">

                        <?php if($page_question): ?>

                                <?php $__currentLoopData = $page_question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 category_name">
                                            <h3 class="box-title"><?php echo e($category['category']['name']); ?></h3>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                    <?php if($category['category']['questions'] && count($category['category']['questions'])>0): ?>
                                        <?php $__currentLoopData = $category['category']['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($question['type'] == 'choice'): ?>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8 card">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                            <tr >
                                                                <th scope="col" colspan="5" style="display: flex;"> <?php echo $question['title']; ?>  <?php if($question['required'] == '1'): ?> <span style="color: #d93025">  &nbsp; *  </span> <?php endif; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col" > </th>
                                                                <?php if($question_options && count($question_options)>0): ?>
                                                                    <th scope="col" class="text-center"><?php echo e($question_options['option_1']); ?></th>
                                                                    <th scope="col" class="text-center"><?php echo e($question_options['option_2']); ?></th>
                                                                    <th scope="col" class="text-center"><?php echo e($question_options['option_3']); ?></th>
                                                                    <th scope="col" class="text-center"><?php echo e($question_options['option_4']); ?></th>
                                                                <?php endif; ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php if($category['users'] && count($category['users'])>0): ?>
                                                                <?php $__currentLoopData = $category['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $induser=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $chosen ='';
                                                                    ?>
                                                                    <?php if($UsersSurveysDetails && count($UsersSurveysDetails)>0): ?>
                                                                        <?php $__currentLoopData = $UsersSurveysDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iii=>$uudd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($question['id'] == $uudd['question_id'] && $user['user_id'] == $uudd['user_id'] ): ?>
                                                                                <?php
                                                                                    $chosen =$uudd['chose_option'];
                                                                                ?>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                    <tr>
                                                                        <th scope="row" class="user_name"><?php echo e($user['user']['name']); ?></th>
                                                                        <td class="text-center"><input type="radio" class="this_option" name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_1" <?php if($chosen == 'option_1'): ?> checked <?php endif; ?>  disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_2"<?php if($chosen == 'option_2'): ?> checked <?php endif; ?> disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_3"<?php if($chosen == 'option_3'): ?> checked <?php endif; ?> disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_4" <?php if($chosen == 'option_4'): ?> checked <?php endif; ?> disabled> </td>
                                                                    </tr>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                </div>
                                            <?php else: ?>

                                            <?php
                                                $answer ='';
                                            ?>
                                            <?php if($UsersSurveysDetails && count($UsersSurveysDetails)>0): ?>
                                                <?php $__currentLoopData = $UsersSurveysDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iii=>$uudd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($question['id'] == $uudd['question_id'] ): ?>
                                                        <?php
                                                            $answer =$uudd['answer'];
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8 card">
                                                        <br>
                                                        <div  style="display: flex;"> <?php echo $question['title']; ?>  <?php if($question['required'] == '1'): ?> <span style="color: #d93025">  &nbsp; *  </span> <?php endif; ?></div>
                                                        <br>
                                                        <div>
                                                            <input type="text" class="form-control specific_input" placeholder="Your answer"  name="<?php echo e($question['id']); ?>" value="<?php echo e($answer); ?>"  disabled>
                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                </div>
                                            <?php endif; ?>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="box-title">No Data</h3>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\eva\survey\resources\views/admin/reports/show.blade.php ENDPATH**/ ?>