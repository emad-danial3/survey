<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle"
            data-toggle="dropdown"><?php echo e(trans('datatable.action')); ?></button>
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="/admin/page/edit/<?php echo e($id); ?>"><?php echo e(trans('datatable.edit')); ?></a></li>
        <li><a href="/admin/page/show/<?php echo e($id); ?>"><?php echo e(trans('datatable.show')); ?></a></li>
        <li><a href="#" onclick="duplicatePage(<?php echo e($id); ?>)" id="duplicate_page<?php echo e($id); ?>"><?php echo e(trans('datatable.duplicate')); ?></a></li>
        <?php if($status == 1): ?>
            <li><a href="#" onclick="disabledConfirmationPage(<?php echo e($id); ?>)" id="disabled_page<?php echo e($id); ?>"><?php echo e(trans('datatable.disabled')); ?></a></li>
        <?php else: ?>
            <li><a href="#" onclick="activatedConfirmationPage(<?php echo e($id); ?>)" id="activated_page<?php echo e($id); ?>"><?php echo e(trans('datatable.activated')); ?></a></li>
        <?php endif; ?>
        <li><a href="#" onclick="deleteConfirmation(<?php echo e($id); ?>)"><?php echo e(trans('datatable.delete')); ?></a></li>
    </ul>
</div>


<script>
    $('#editContract',<?php echo e($id); ?>).on('shown.bs.modal', function () {
        $('#myInput',<?php echo e($id); ?>).trigger('focus')
    });

    $(document).ready(function () {
        $('.select4').select2();
    });
</script>


<script type="text/javascript">
    function duplicatePage(id) {
        swal({
            title: "<?php echo e(trans('datatable.duplicate?')); ?>",
            text: "<?php echo e(trans('datatable.Please ensure and then confirm!')); ?>",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(trans('datatable.Yes, duplicate it!')); ?>",
            cancelButtonText: "<?php echo e(trans('datatable.No, cancel!')); ?>",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(url('admin/page/duplicate')); ?>/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            $('#datatable_page').DataTable().ajax.reload();
                            
                            swal("<?php echo e(trans('datatable.Done!')); ?>", results.message, "success");
                        } else {
                            swal("<?php echo e(trans('datatable.Error!')); ?>", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }


  function disabledConfirmationPage(id) {
        swal({
            title: "<?php echo e(trans('datatable.disabled?')); ?>",
            text: "<?php echo e(trans('datatable.Please ensure and then confirm!')); ?>",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(trans('datatable.Yes, disabled it!')); ?>",
            cancelButtonText: "<?php echo e(trans('datatable.No, cancel!')); ?>",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(url('admin/page/disabled')); ?>/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_page').DataTable().ajax.reload();
                            swal("<?php echo e(trans('datatable.Done!')); ?>", results.message, "success");
                        } else {
                            swal("<?php echo e(trans('datatable.Error!')); ?>", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }

    function activatedConfirmationPage(id) {
        swal({
            title: "<?php echo e(trans('datatable.activated?')); ?>",
            text: "<?php echo e(trans('datatable.Please ensure and then confirm!')); ?>",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(trans('datatable.Yes, activated it!')); ?>",
            cancelButtonText: "<?php echo e(trans('datatable.No, cancel!')); ?>",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(url('admin/page/activated')); ?>/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_page').DataTable().ajax.reload();
                            swal("<?php echo e(trans('datatable.Done!')); ?>", results.message, "success");
                        } else {
                            $('#datatable5').DataTable().ajax.reload();
                            swal("<?php echo e(trans('datatable.Error!')); ?>", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }


    function deleteConfirmation(id) {
        swal({
            title: "<?php echo e(trans('datatable.Delete?')); ?>",
            text: "<?php echo e(trans('datatable.Please ensure and then confirm!')); ?>",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(trans('datatable.Yes, delete it!')); ?>",
            cancelButtonText: "<?php echo e(trans('datatable.No, cancel!')); ?>",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(url('admin/page/delete')); ?>/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_page').DataTable().ajax.reload();
                            swal("<?php echo e(trans('datatable.Done!')); ?>", results.message, "success");
                        } else {
                            swal("<?php echo e(trans('datatable.Error!')); ?>", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>
<?php /**PATH E:\emad\survey\resources\views/admin/pages/btn/action.blade.php ENDPATH**/ ?>