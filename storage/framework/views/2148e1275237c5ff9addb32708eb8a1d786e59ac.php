<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            margin-top: 150px;
            background-color: #C4CCD9;
        }
        i{
            font-size:90px !important;
            color:#5D6572;
            margin-top:20px;
        }
        .error-main{
            background-color: #fff;
            box-shadow: 0px 10px 10px -10px #5D6572;
        }
        .error-main h1{
            font-weight: bold;
            color: #444444;
            font-size: 100px;
            text-shadow: 2px 4px 5px #6E6E6E;
        }
        .error-main h6{
            color: #42494F;
        }
        .error-main p{
            color: #9897A0;
            font-size: 14px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <i class="fa fa-frown-o" aria-hidden="true"></i>
                        <h5 class="m-0"> ACCES INTERDIT</h5>
                       <p>  Oops, Vous n'êtes pas autorisé à accéder à cette page..</p> 
                       <a class="btn btn-dark btn-lg" role="button" href="<?php echo e(url()->previous()); ?>">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php /**PATH /var/www/top-patissier.net/resources/views/errors/403.blade.php ENDPATH**/ ?>