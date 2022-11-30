<!DOCTYPE html>
<html lang="en">
<head>
    <title> Survey Web Site</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .category_name{
            text-align: center;
            border-radius: 7px;
            background-color: rgb(123, 55, 10);
            color: rgba(255, 255, 255, 1);
            padding: 12px 24px;
        }
        .card{
            border: 1px solid #ddd;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .user_name{
            max-width: 350px;
            width: 350px;
            overflow: hidden
        }
        .this_option{
            width: 20px;
            height: 20px;
        }
        .specific_input,.specific_input:focus{
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }


    </style>
</head>
<body>

<div class="jumbotron text-center">
    <h3 class="box-title"><?php echo e($model->name); ?></h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">

                        <?php if($page_question): ?>


                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(url('saveSurvey')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php if($model): ?>
                                        <input type="hidden"  name="LAST_NAME" id="LAST_NAME" value="<?php echo e($LAST_NAME); ?>">
                                        <input type="hidden"  name="EMPLOYEE_ID" id="EMPLOYEE_ID" value="<?php echo e($EMPLOYEE_ID); ?>">
                                        <input type="hidden"  name="EMAIL_ADDRESS" id="EMAIL_ADDRESS" value="<?php echo e($EMAIL); ?>">
                                        <input type="hidden"  name="location_id" id="location_id" value="<?php echo e($location_id); ?>">
                                        <input type="hidden"  name="survey_id" id="survey_id" value="<?php echo e($model->id); ?>">
                                    <?php endif; ?>

                                <?php $__currentLoopData = $page_question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8 category_name">
                                        <h3 class="box-title"><?php echo e($category['category']['name']); ?> - <?php echo e($category['location']['name']); ?></h3>
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
                                                            <tr>
                                                                <th scope="row" class="user_name"><?php echo e($user['user']['name']); ?></th>
                                                                <td class="text-center"><input type="radio" class="this_option" name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_1" <?php if($question['required'] == '1'): ?> required <?php endif; ?> >  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_2">  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_3">  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="<?php echo e($question['id']); ?>-<?php echo e($user['user']['id']); ?>" value="option_4"> </td>
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
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                        </div>
                                                        <div class="col-md-8 card">
                                                            <br>
                                                            <div  style="display: flex;"> <?php echo $question['title']; ?>  <?php if($question['required'] == '1'): ?> <span style="color: #d93025">  &nbsp; *  </span> <?php endif; ?></div>
                                                            <br>
                                                            <div>
<input type="text" class="form-control specific_input" placeholder="Your answer"  name="<?php echo e($question['id']); ?>"  <?php if($question['required'] == '1'): ?> required <?php endif; ?> >
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
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>


                                </form>

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

    </div>
</div>

</body>
</html>
<?php /**PATH E:\emad\survey\resources\views/survey.blade.php ENDPATH**/ ?>