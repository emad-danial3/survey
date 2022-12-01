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
</head>
<body>

<div class="jumbotron text-center">
    <h3 class="box-title"><?php echo e($model->name); ?></h3>
</div>

<div class="container">
    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-8">

            <?php if(isset($errorMessageDuration)): ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo e($errorMessageDuration); ?>

                </div>
            <?php endif; ?>


            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(url('getLocationSurvey')); ?>">
                <?php echo csrf_field(); ?>

                <?php if($user &&$email): ?>
                    <input type="hidden"  name="LAST_NAME" id="LAST_NAME" value="<?php echo e($user['data']['LAST_NAME']); ?>">
                    <input type="hidden"  name="EMPLOYEE_ID" id="EMPLOYEE_ID" value="<?php echo e($user['data']['EMPLOYEE_ID']); ?>">
                    <input type="hidden"  name="email" id="email" value="<?php echo e($email); ?>">
                <?php endif; ?>



                <div class="form-group">
                    <?php $locations = app('App\Models\Locations'); ?>
                    <?php if($locations->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                        <div class="form-group">
                            <h4>
                                <label for="location_id"><?php echo e(trans('admin.location_id')); ?> *</label>
                            </h4>

                            <select class="form-control select2" id="location_id" required
                                    name="location_id">
                                <option value=""><?php echo e(trans('admin.location_id')); ?></option>
                                <?php $__currentLoopData = $locations->where('id','>', 0)->where('status', '1')->where('location_type', 'special')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($location->id); ?>">
                                        <?php echo e($location->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Next</button>
            </form>
            <div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>


</body>
</html>

<?php /**PATH E:\emad\survey\resources\views/location.blade.php ENDPATH**/ ?>