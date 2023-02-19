<!doctype html>
<html lang="en">

<head>

    <title> List All Files Policies </title>

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv="keywords" content="Online Order"/>
    <meta http-equiv="description" content="Online Order"/>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>


    <link href='{{url('/')}}/polices_files/css/bootstrap.css' rel='stylesheet' type='text/css'/>
    <link href='{{url('/')}}/polices_files/css/default.css' rel='stylesheet' type='text/css'/>


</head>


<body>

<style>
    #myTable_filter {
        text-align: left;
    }

    ;

    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

</style>

<input type="hidden" name="current_path" id="current_path" value="">

<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img class="navbar-brand-logo nav_bar_image" src='{{url('/')}}/polices_files/logo_egypt.png' alt=""/>
            </a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Atr <span class="caret"></span>
                    </a>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>


<div class="loading-container d-none">
    <i class="fa fa-refresh fa-spin fa-5x text-primary"></i>
</div>


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12 mt-10">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a href="/policies" class="btn btn-success">Normal Indexing</a>
                </div>
                <div class="panel-body">
                    <div class="list-group text-center font-18">

                        <table class="table table-striped text-center table-responsive" id="myTable" style="font-size: 18px">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>اسم آلإدارة</td>
                                <td>البند</td>
                                <td>اسم السياسة</td>
                                <td>المحتوي</td>
                                <td>رقم الصفحة</td>
                                <td>رابط</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($atr_policies as $key => $item): ?>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->Departments->first()->name}}</td>
                                <td>{{$item->clause}}</td>
                                <td>{{$item->policy_name}}</td>
                                <td>{{$item->policy_content}}</td>
                                <td>{{$item->policy_page}}</td>
                                <td>
                                    <a href="{{$item->policy_path}}" target="_blank" class="btn btn-primary">رابط</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>




                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src='{{url('/')}}/polices_files/js/jquery.js'></script>
<script src='{{url('/')}}/polices_files/js/bootstrap.js'></script>
<script src='{{url('/')}}/polices_files/js/select2.min.js'></script>
<script src='{{url('/')}}/polices_files/js/default.js'></script>
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function () {

        // DataTable
        $('#myTable').DataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
            "bLengthChange": false,
        });

    });

</script>


</body>

</html>
