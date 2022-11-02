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
    <h3 class="box-title">{{$model->name}}</h3>
    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <br>
            <br>
            <br>
            <div class="alert alert-success">
                <strong>Success!</strong> Survey Saved Successfully.
            </div>
            <div class="alert alert-info">
                <strong>Thank you</strong>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>



</div>

<div class="container">
    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-8">
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>


</body>
</html>

