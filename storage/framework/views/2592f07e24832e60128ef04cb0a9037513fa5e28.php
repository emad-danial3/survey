<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.settings')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="message-flash">
                        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <form action="<?php echo e(route('settings.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone"><?php echo e(trans('admin.phone')); ?></label>
                                    <input type="text" class="form-control" name="phone"
                                           placeholder="<?php echo e(trans('admin.phone')); ?>"
                                           <?php if(isset($settings->phone)): ?> value="<?php echo e($settings->phone); ?>" <?php endif; ?>>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="blog_email"><?php echo e(trans('admin.email')); ?></label>
                                    <input type="text" class="form-control" name="email"
                                           placeholder="<?php echo e(trans('admin.email')); ?>"
                                           <?php if(isset($settings->email)): ?>  value="<?php echo e($settings->email); ?>" <?php endif; ?>>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(trans('admin.question_options')); ?></label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="option_1"><?php echo e(trans('admin.option_1')); ?></label>
                                    <input type="text" class="form-control" name="option_1"
                                           placeholder="<?php echo e(trans('admin.option_1')); ?>"
                                           <?php if(isset($settings->option_1)): ?>  value="<?php echo e($settings->option_1); ?>" <?php endif; ?>>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_2"><?php echo e(trans('admin.option_2')); ?></label>
                                    <input type="text" class="form-control" name="option_2"
                                           placeholder="<?php echo e(trans('admin.option_2')); ?>"
                                           <?php if(isset($settings->option_2)): ?>  value="<?php echo e($settings->option_2); ?>" <?php endif; ?>>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_3"><?php echo e(trans('admin.option_3')); ?></label>
                                    <input type="text" class="form-control" name="option_3"
                                           placeholder="<?php echo e(trans('admin.option_3')); ?>"
                                           <?php if(isset($settings->option_3)): ?>  value="<?php echo e($settings->option_3); ?>" <?php endif; ?>>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_4"><?php echo e(trans('admin.option_4')); ?></label>
                                    <input type="text" class="form-control" name="option_4"
                                           placeholder="<?php echo e(trans('admin.option_4')); ?>"
                                           <?php if(isset($settings->option_4)): ?>  value="<?php echo e($settings->option_4); ?>" <?php endif; ?>>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text"><?php echo e(trans('admin.text')); ?></label>
                                <textarea name="text" class="form-control"
                                          placeholder="<?php echo e(trans('admin.Enter Description')); ?>"
                                          rows="3"> <?php if(isset($settings->text)): ?>  <?php echo e($settings->text); ?> <?php endif; ?></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="whats_app"><?php echo e(trans('admin.whats_app')); ?></label>
                                    <input type="text" class="form-control" name="whats_app"
                                           placeholder="<?php echo e(trans('admin.whats_app')); ?>"
                                           <?php if(isset($settings->whats_app)): ?> value="<?php echo e($settings->whats_app); ?>" <?php endif; ?>>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="instagram"><?php echo e(trans('admin.instagram')); ?></label>
                                    <input type="text" class="form-control" name="instagram"
                                           placeholder="<?php echo e(trans('admin.instagram')); ?> "
                                           <?php if(isset($settings->instagram)): ?> value="<?php echo e($settings->instagram); ?>" <?php endif; ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="you_tube"><?php echo e(trans('admin.you_tube')); ?></label>
                                    <input type="text" class="form-control" name="you_tube"
                                           placeholder="<?php echo e(trans('admin.you_tube')); ?>"
                                           <?php if(isset($settings->you_tube)): ?> value="<?php echo e($settings->you_tube); ?>" <?php endif; ?>>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="twitter"><?php echo e(trans('admin.twitter')); ?></label>
                                    <input type="text" class="form-control" name="twitter"
                                           placeholder="<?php echo e(trans('admin.twitter')); ?>"
                                           <?php if(isset($settings->twitter)): ?> value="<?php echo e($settings->twitter); ?>" <?php endif; ?>>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="facebook"><?php echo e(trans('admin.facebook')); ?></label>
                                    <input type="text" class="form-control" name="facebook"
                                           placeholder="<?php echo e(trans('admin.facebook')); ?>"
                                           <?php if(isset($settings->facebook)): ?> value="<?php echo e($settings->facebook); ?>" <?php endif; ?>>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image"><?php echo e(trans('admin.image_site')); ?></label>
                                    <input type="file" class="form-control-file" name="image">
                                    <?php if(isset($settings->image)): ?>
                                        <img src="<?php echo e(asset($settings->image)); ?>" alt="000000" class="img-thumbnail"
                                             width="50px" height="50px">
                                    <?php endif; ?>
                                </div>

                            </div>





                            <button type="submit" class="btn btn-primary btn-lg"><?php echo e(trans('admin.edit')); ?></button>
                        </form>
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
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>