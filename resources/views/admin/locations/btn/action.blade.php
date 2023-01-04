<div class="btn-group">
    <button type="button" class="btn btn-warning dropdown-toggle"
            data-toggle="dropdown">{{trans('datatable.action')}}</button>
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{url(route('admin.locations.edit', $id))}}">{{trans('datatable.edit')}}</a></li>
        <li><a href="#" onclick="deleteConfirmationCategories({{$id}})">{{trans('datatable.delete')}}</a></li>
        @if($status == 1)
            <li><a href="#" onclick="disabledConfirmationPage({{$id}})" id="disabled_page{{ $id }}">{{trans('datatable.disabled')}}</a></li>
        @else
            <li><a href="#" onclick="activatedConfirmationPage({{$id}})" id="activated_page{{ $id }}">{{trans('datatable.activated')}}</a></li>
        @endif
    </ul>
</div>


<script>
    $('#editContract',{{$id}}).on('shown.bs.modal', function () {
        $('#myInput',{{$id}}).trigger('focus')
    });

    $(document).ready(function () {
        $('.select4').select2();
    });
</script>

{{-- Delete --}}
<script type="text/javascript">




    function disabledConfirmationPage(id) {
        swal({
            title: "{{trans('datatable.disabled?')}}",
            text: "{{trans('datatable.Please ensure and then confirm!')}}",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{trans('datatable.Yes, disabled it!')}}",
            cancelButtonText: "{{trans('datatable.No, cancel!')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/location/disabled')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_location').DataTable().ajax.reload();
                            swal("{{trans('datatable.Done!')}}", results.message, "success");
                        } else {
                            swal("{{trans('datatable.Error!')}}", results.message, "error");
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
            title: "{{trans('datatable.activated?')}}",
            text: "{{trans('datatable.Please ensure and then confirm!')}}",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{trans('datatable.Yes, activated it!')}}",
            cancelButtonText: "{{trans('datatable.No, cancel!')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/location/activated')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_location').DataTable().ajax.reload();
                            swal("{{trans('datatable.Done!')}}", results.message, "success");
                        } else {
                            $('#datatable5').DataTable().ajax.reload();
                            swal("{{trans('datatable.Error!')}}", results.message, "error");
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

    function deleteConfirmationCategories(id) {
        swal({
            title: "{{trans('datatable.Delete?')}}",
            text: "{{trans('datatable.Please ensure and then confirm!')}}",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{trans('datatable.Yes, delete it!')}}",
            cancelButtonText: "{{trans('datatable.No, cancel!')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/location/delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            $('#datatable_location').DataTable().ajax.reload();
                            swal("{{trans('datatable.Done!')}}", results.message, "success");
                        } else {
                            swal("{{trans('datatable.Error!')}}", results.message, "error");
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
