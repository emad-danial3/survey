<!doctype html>
<html lang="en">

<head>

    <title> Policies </title>

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv="keywords" content="Online Order"/>
    <meta http-equiv="description" content="Online Order"/>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>


    <link href='{{url('/')}}/polices_files/css/bootstrap.css' rel='stylesheet' type='text/css'/>
    <link href='{{url('/')}}/polices_files/css/default.css' rel='stylesheet' type='text/css'/>


</head>


<body>

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


<div class="container">
    <div class="row">

        <div class="col-md-12 mt-10">

            <div class="panel panel-primary">
                <div class="panel-heading">

                    <a onclick="location.reload()" class="btn btn-success">Main Menu</a>
                    <a class="btn btn-warning back">Back</a>
                    <a href="policies/list_all_files" class="btn btn-danger pull-right">List All Files</a>
                    <a href="policies/indexing_policies" class="btn btn-success pull-right mr-10 ml-10">Indexing Policies</a>

                </div>

                <div class="panel-body">


                    <div class="list-group text-center font-18 list_polices">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The modal -->
<div class="modal fade" id="largeShoes" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabelLarge">Show Policies</h4>
            </div>
            <div class="modal-body" id="model_content">....</div>
        </div>
    </div>
</div>


<script src='{{url('/')}}/polices_files/js/jquery.js'></script>
<script src='{{url('/')}}/polices_files/js/bootstrap.js'></script>
<script src='{{url('/')}}/polices_files/js/select2.min.js'></script>
<script src='{{url('/')}}/polices_files/js/default.js'></script>


<script>
    $(document).ready(function () {

        function getFiles() {

            let base_url = 'policies_files';
            let formData = new FormData();
                formData.append("current_path", $('#current_path').val());
                formData.append("_token",'{{ csrf_token() }}')


            ajaxRequest(base_url, formData, function (response) {

                $('.list_polices').html("");

                response.data.forEach(function (item) {
                    if (item.file_name != "index.php") {

                        let item_link           = "#";
                        let item_link_file_path = item.file_path;
                        let icon                = '<i class="fa fa-folder-open-o  fa-1x"></i>';

                        if (item.file_name.split(".").length > 1) {
                            item_link           = item.file_path;
                            item_link_file_path = "#";
                            icon                = '<i class="fa fa-files-o  fa-1x"></i>';
                        }

                        $('.list_polices').append(`<a
                                                        href='#'
                                                        data-path='${item_link_file_path}'
                                                        data-redirect='${item_link}'
                                                        class='list-group-item marign_5px menu_link get_files'>
                                                        ${icon}
                                                        ${item.file_name_with_out_extension}
                                                </a>`);
                    }
                })

            });
        }

        getFiles();

        $('body').on('click', '.get_files', function () {

            let path     = $(this).data("path");
            let redirect = $(this).data("redirect");


            if (redirect !== "#") {

                $('#model_content').html('<embed oncontextmenu="myFunction()"  src="' + redirect + '#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" width="100%" height="500px">');
                $('#modalLabelLarge').html(`<a class='btn btn-primary'  target="_blank" href='${redirect}'> Show Polciies </a>`);
                $('#largeShoes').modal();
                return;
            }

            $('#current_path').val(path);

            getFiles();
        })

        $('body').on('click', '.back', function () {

            let path = $('#current_path').val();

            if (path === "") {
                return;
            }

            path         = path.split("/");
            let new_path = "";
            for (let i = 0; i < path.length - 1; i++) {
                new_path += path[i] + "/";
            }


            $('#current_path').val(new_path.slice(0, -1));
            getFiles();

        });


    });
</script>


</body>

</html>
