<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="parsley-errors-list filled">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="parsley-required"><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH E:\emad\survey\resources\views/partials/validations_errors.blade.php ENDPATH**/ ?>