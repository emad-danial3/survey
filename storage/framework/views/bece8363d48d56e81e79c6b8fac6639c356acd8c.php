<?php $model = app('App\Models\Question'); ?>
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.questionCreate')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.questions')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.questionCreate')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\QuestionController@questionStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>



                        <?php $categories = app('App\Models\Category'); ?>
                        <?php if($categories->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                            <div class="form-group">
                                <label for="category_id"><?php echo e(trans('admin.category_id')); ?> *</label>
                                <select class="form-control select2" id="category_id" required
                                        name="category_id">
                                    <option value="0"><?php echo e(trans('admin.category_id')); ?></option>
                                    <?php $__currentLoopData = $categories->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($category->id); ?>">
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>


                        <?php $__env->startPush('scripts'); ?>
                            <script>
                                CKEDITOR.replace('question_title');
                            </script>
                        <?php $__env->stopPush(); ?>


                        <div class="form-group col-md-12" id="questions_container_body">
                            <div id="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="question_title">Question Title</label>

                                        <?php echo Form::textarea('question_title', null , ['class' => 'form-control', 'required' => 'required']); ?>


                                    </div>
                                    <div class="col-md-2">

                                        <label for="question_type">Question Type</label>
                                        <select id="question_type" name="question_type" class="form-control">
                                            <option value="choice">Choice</option>
                                            <option value="article">Article</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="question_required">Question Required ?</label>
                                        <select id="question_required" name="question_required" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 row" id="questions_options_container">
                                        <div class="col-md-12">
                                            <h4>
                                                <label>Options</label>
                                            </h4>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_option_1">Option 1</label><br>
                                            <label for="question_option_1"><?php echo e($question_options['option_1']); ?></label>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_option_2">Option 2</label><br>
                                            <label for="question_option_2"><?php echo e($question_options['option_2']); ?></label>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_option_3">Option 3</label><br>
                                            <label for="question_option_3"><?php echo e($question_options['option_3']); ?></label>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_option_4">Option 4</label><br>
                                            <label for="question_option_4"><?php echo e($question_options['option_4']); ?></label>

                                        </div>
                                    </div>

                                </div>


                            </div>


                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.submit')); ?></button>
                        </div>

                        <?php echo Form::close(); ?>

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

            $("#question_type").change(function () {
                var q_t = $("#question_type").val();
                if (q_t == 'article') {
                    $("#questions_options_container").hide();
                } else {
                    $("#questions_options_container").show();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/questions/create.blade.php ENDPATH**/ ?>