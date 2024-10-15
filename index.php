<html lang="en" manifest="manifest.appcache">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Meter Data Management System (MDMS) for GEOP Customers</title>
      
  <!-- endinject --> 
    <link rel="stylesheet" type="text/css" href="vendors/bootstrap/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="images/ben2.png" >
    <style type="text/css">.clb5sj5bb00003569ft6es8g6:hover {background:#ddd !important;}</style>
    <style>.tw-button *{cursor:pointer}.tw-button button{border-width:1px;border-style:solid;position:relative}.tw-button .mini{height:auto;padding:.2rem .4rem;font-size:.75rem;line-height:1;border-radius:.2rem;box-shadow:none}.tw-button .small{height:auto;padding:.25rem .75rem;font-size:.85rem;line-height:1.5;border-radius:.2rem;box-shadow:none}.tw-button .default{height:auto;padding:.375rem 1rem;font-size:1rem;line-height:1.5;border-radius:.25rem;box-shadow:none}.tw-button .large{height:auto;padding:.75rem 1.25rem;font-size:1.25rem;line-height:1.33333;border-radius:.3rem;box-shadow:none}.tw-button .solid{color:#fff;background-color:#0793ca;border-color:#0793ca;box-shadow:none}.tw-button .solid:hover{color:#fff;background-color:#056f99;border-color:#05688f}.tw-button .outline{color:#0793ca;background-image:none;background-color:transparent;border-color:#0793ca;box-shadow:none}.tw-button .outline:hover{color:#fff;background-color:#0793ca;border-color:#0793ca}.tw-button .link{font-weight:normal;color:#0793ca;border-radius:0;background-color:transparent;border-color:transparent;box-shadow:none}.tw-button .link:hover{color:#014c8c;text-decoration:underline;background-color:transparent;border-color:transparent}.tw-button .link:hover span{text-decoration:underline}.tw-button .clear{color:#fff;background-image:none;background-color:transparent;border-color:#fff}.tw-button .clear:hover{color:#0793ca;background-color:#fff;border-color:#fff}.tw-button .empty{color:#999;background-image:none;background-color:transparent;border-color:#999}.tw-button .empty:hover{color:#fff;background-color:#999;border-color:#999}.tw-button .secondary{color:#ccc;background-image:none;background-color:transparent;border-color:#ccc}.tw-button .secondary:hover{color:#fff;background-color:#ccc;border-color:#ccc}.tw-button .cancel{color:#373a3c;background-color:#fff;border-color:#ccc}.tw-button .cancel:hover{color:#d9534f;background-image:none;background-color:transparent;border-color:#d9534f}.tw-button .secondaryCTA{color:#373a3c;background-color:#fff;border-color:#ccc}.tw-button .secondaryCTA:hover{color:#373a3c;background-color:#e6e6e6;border-color:#adadad}@keyframes spinner{to{transform:rotate(360deg)}}.tw-button .loading{background-size:0 !important}.tw-button .loading:before{content:"";box-sizing:border-box;position:absolute;top:50%;left:50%;width:16px;height:16px;margin-top:-6px;margin-left:-9px;border-radius:50%;border:2px solid #ccc;border-top-color:#0793ca;animation:spinner .6s linear infinite}</style>
    <style>
            .flipX video::-webkit-media-text-track-display {
                transform: matrix(-1, 0, 0, 1, 0, 0) !important;
            }
            .flipXY video::-webkit-media-text-track-display {
                transform: matrix(-1, 0, 0, -1, 0, 0) !important;
            }
            .flipXYX video::-webkit-media-text-track-display {
                transform: matrix(1, 0, 0, -1, 0, 0) !important;
            }</style>
    <style>
            @keyframes blinkWarning {
                0% { color: red; }
                100% { color: white; }
            }
            @-webkit-keyframes blinkWarning {
                0% { color: red; }
                100% { color: white; }
            }
            .blinkWarning {
                -webkit-animation: blinkWarning 1s linear infinite;
                -moz-animation: blinkWarning 1s linear infinite;
                animation: blinkWarning 1s linear infinite;
            }</style>
    </head>
    <body>
    <?php
if(isset($_GET['login_err'])) {
	$error = $_GET['login_err'];
	print '<center><b style="color:red;">';
	echo"$error";
	print '</b></center>';
}
?>

<?php
if(isset($_GET['message'])) {
	$error = $_GET['message'];
	print '<center><b style="color:green;">';
	echo"$error";
	print '</b></center>';
}
?>    <div class="wrapper wrapper-full-page">
            <section id="site-content">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="row logohead">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="logo">
                                    <div class="" pull-left="">
                                        <div class="loginlogo">
                                            <img src="images/ben2.png">
                                            <p class="logotextL">BENECO </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="" pull-right="">
                                    <p class="logotextR">Meter Data Management System for GEOP Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="full-page login-page" data-image="images/sd_landscape.jpg">
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                    <form id="login_form" action="build/login.php" method="post">
                                        <div class="card" data-background="color" data-color="blue">
                                            <div class="card-header"><h3 class="card-title">Login</h3>
                                            </div>
                                            <div class="card-content"><p id="loginmsg"></p>
                                                <div class="form-group"><label>Username</label>
                                                    <input type="text" name="username" id ="username" class="form-control border-input" placeholder="Username" required="required">
                                                </div>
                                                <div class="form-group"><label>Password</label>
                                                    <input type="password" name="password" id="password" class="form-control border-input" placeholder="Password" required="required">
                                                </div></div><div class="card-footer text-center">
                                                    <button type="submit" name="login" class="btn btn-info btn-fill btn-wd "> Login </button>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
     
 
    </body>
</html>