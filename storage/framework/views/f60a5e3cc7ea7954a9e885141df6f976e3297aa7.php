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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            Employee Name : <?php echo e($user->name); ?>

                                        </div>
                                        <div class="col-sm-6">
                                           Location Name : <?php echo e($location->name); ?>

                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped arabicStyle">
                                            <thead>
                                            <tr role="row">




                                                <th  class="arabicStyle"> م </th>
                                                <th  class="arabicStyle"> سؤال استطلاع الراي </th>
                                                <th  class="arabicStyle" colspan="4">
                                                    <table class="table " style="margin-bottom: 0px">
                                                        <tr>
                                                            <th colspan="4" class="text-center"> عدد الذين قاموا بالاستطلاع</th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="arabicStyle">جيد</th>
                                                            <td>متوسط</td>
                                                            <td>ضعيف</td>
                                                            <td>N/A</td>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="arabicStyle">TOTAL</th>
                                                <th class="arabicStyle">جيد</th>
                                                <th class="arabicStyle">متوسط</th>
                                                <th class="arabicStyle">ضعيف</th>
                                                <th class="arabicStyle">N/A</th>
                                                <th class="arabicStyle">SUM</th>
                                            </tr>
                                            </thead>
                                            <tbody >

                                            <?php $__currentLoopData = $usersMakeSurveyQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr >
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td class="text-right"> <?php echo $record->title; ?> </td>
                                                    <td class="text-center"> <?php echo e($record->option_1_count); ?> </td>
                                                    <td class="text-center"> <?php echo e($record->option_2_count); ?> </td>
                                                    <td class="text-center"> <?php echo e($record->option_3_count); ?> </td>
                                                    <td class="text-center"> <?php echo e($record->option_4_count); ?> </td>
                                                    <td class="text-center"> <?php echo e($record->total_count); ?> </td>
                                                    <td class="text-center"> <?php echo e($record->total_option_1_percent); ?>   % </td>
                                                    <td class="text-center"> <?php echo e($record->total_option_2_percent); ?>   % </td>
                                                    <td class="text-center"> <?php echo e($record->total_option_3_percent); ?>   % </td>
                                                    <td class="text-center"> <?php echo e($record->total_option_4_percent); ?>   % </td>
                                                    <td class="text-center"> <?php echo e($record->total_percentage); ?>  % </td>


                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr >
                                                <th colspan="2" class="text-center" style="background-color: #ffdf02">الاجمالي</th>
                                                <th class="text-center"> <?php echo e($sum_option_1_count); ?> </th>
                                                <th class="text-center"> <?php echo e($sum_option_2_count); ?> </th>
                                                <th class="text-center"> <?php echo e($sum_option_3_count); ?> </th>
                                                <th class="text-center"> <?php echo e($sum_option_4_count); ?> </th>
                                                <th class="text-center">  </th>
                                                <th colspan="4" class="text-center" style="background-color: #bdd8fc">متوسط تقييم الموظف</th>
                                                <th class="text-center" style="color: #d9252b;background-color: #bdd8fc"> <?php echo e($final_total_sum_percentage); ?> % </th>
                                            </tr>

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