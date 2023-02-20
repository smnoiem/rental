<?php
    include("conn.php");
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    session_start();
    $currDT = date("Y-m-d H:i:s");
    if(isset($_POST['email'])&&isset($_POST['vericode'])&&isset($_POST['password'])&&isset($_POST['confirm'])){
        //reset pass
        $email = $_POST['email'];
        $token = $_POST['vericode'];
        $p1 = $_POST['password'];
        $p2 = $_POST['confirm'];
        
        $usQ = "SELECT * FROM users WHERE email='$email' and token='$token'";
        $usR = mysqli_query($db, $usQ);
        $usRow = mysqli_fetch_array($usR, MYSQLI_ASSOC);
        
        
        if(mysqli_num_rows($usR)==1&&$usRow['token_exp']>=$currDT){
            if($p1==$p2 && $p1 !=""){
                $pwdH = password_hash($p1, PASSWORD_DEFAULT);
                $pwQ = "UPDATE users SET password='$pwdH', token_exp='$currDT' WHERE email='$email'";
                if(mysqli_query($db, $pwQ)){
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $usRow['id'];
                    $_SESSION['user_type'] = $usRow['user_type'];
                    $_SESSION['fname'] = $usRow['fname'];
                    $_SESSION['lname'] = $usRow['lname'];
                    header("location: /index.php");
                }
                else{
                    $output="
                        <section class=\"section-padding\">
                           <div class=\"container\">
                              <div class=\"row justify-content-center\">
                                 <div class=\"col-lg-5 col-md-12 col-xs-12\">
            
                                <div class=\"alert alert-danger\">
                                     Database update failed.
                                </div>
                                    </div>
                              </div>
                           </div>
                        </section>
                    ";
                }
            }
            else{
                $output = "
    
                    <div id=\"page-wrapper\">
                    <div class=\"container\">
                        <div class=\"row\">
                        <div class=\"col-xs-12 col-md-4 col-md-offset-4\">
                            <h2 class=\"text-center\" style=\"font-size:28px;\">Hello $usRow[fname],</h2>
                            <p class=\"text-center\">Please enter desired password in a valid format.</p>
                            <form action=\"forgot-password-reset.php\" method=\"post\">
                                <div class=\"alert alert-danger\">
                                    <ul class=\"\">
                                        <li class=\"text-center\">New Password and Confirm Password must match</li>
                                        <script>jQuery(\"#New Password and Confirm Password must match\").parent().closest(\"div\").addClass(\"has-error\");</script>
                                    </ul>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"password\">New Password:</label>
                                    <input type=\"password\" name=\"password\" value=\"\" id=\"password\" class=\"form-control\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"confirm\">Confirm Password:</label>
                                    <input type=\"password\" name=\"confirm\" value=\"\" id=\"confirm\" class=\"form-control\">
                                </div>
                                <input type=\"hidden\" name=\"email\" value=\"$email\">
                                <input type=\"hidden\" name=\"vericode\" value=\"$token\">
                                <input type=\"submit\" name=\"resetPassword\" value=\"Reset\" class=\"btn btn-common log-btn\">
                            </form>
                            <br/>
                        </div>
                        </div>
                    </div>
                    </div>
    
                ";
                
            }
            
        }
        else{
            $output="
                <section class=\"section-padding\">
                   <div class=\"container\">
                      <div class=\"row justify-content-center\">
                         <div class=\"col-lg-5 col-md-12 col-xs-12\">
    
                        <div class=\"alert alert-danger\">
                             The linked you clicked is not valid or expired.
                        </div>
                            </div>
                      </div>
                   </div>
                </section>
            ";
        }
    }
    else if(isset($_GET['email'])&&isset($_GET['vericode'])){
        $email = $_GET['email'];
        $token = $_GET['vericode'];
        $usQ = "SELECT * FROM users WHERE email='$email' and token='$token'";
        $usR = mysqli_query($db, $usQ);
        $usRow = mysqli_fetch_array($usR, MYSQLI_ASSOC);
        
        
        if(mysqli_num_rows($usR)==1&&$usRow['token_exp']>=$currDT){
            session_destroy();
            $output = "

                <div id=\"page-wrapper\">
                <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-xs-12 col-md-4 col-md-offset-4\">
                        <h2 class=\"text-center\" style=\"font-size:28px;\">Hello $usRow[fname],</h2>
                        <p class=\"text-center\">Please reset your password.</p>
                        <form action=\"forgot-password-reset.php\" method=\"post\">
                            <div class=\"form-group\">
                                <label for=\"password\">New Password:</label>
                                <input type=\"password\" name=\"password\" value=\"\" id=\"password\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"confirm\">Confirm Password:</label>
                                <input type=\"password\" name=\"confirm\" value=\"\" id=\"confirm\" class=\"form-control\">
                            </div>
                            <input type=\"hidden\" name=\"email\" value=\"$email\">
                            <input type=\"hidden\" name=\"vericode\" value=\"$token\">
                            <input type=\"submit\" name=\"resetPassword\" value=\"Reset\" class=\"btn btn-common log-btn\">
                        </form>
                        <br/>
                    </div>
                    </div>
                </div>
                </div>

            ";
        }
        else{
            $output = "
            <section class=\"section-padding\">
               <div class=\"container\">
                  <div class=\"row justify-content-center\">
                     <div class=\"col-lg-5 col-md-12 col-xs-12\">

                    <div class=\"alert alert-danger\">
                         The linked you clicked is not valid or expired.
                    </div>
                        </div>
                  </div>
               </div>
            </section>
            ";
        }
    }
    else{
        header("Location: /index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">

	<title>Reset Forgotten Password Quickon Rentals</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="/users/css/color_schemes/bootstrap.min.css" rel="stylesheet">
	<link href="/users/css/sb-admin.css" rel="stylesheet">
	<link href="/users/css/datatables.css" rel="stylesheet">

	<link href="/users/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/fonts/line-icons.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/slicknav.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/nivo-lightbox.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
	<link rel="shortcut icon" type="image/png" href="/assets/favicon.png"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="/assets/js/jquery-min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<style>
.nounderline{text-decoration: none !important}

@media screen and (max-width: 767px) {
body {
  padding-top: 11px;
}
}
@media screen and (min-width: 768px) and (max-width: 1199px){
body {
  padding-top: 60px;
}
}
@media screen and (min-width: 1200px){
body {
  padding-top: -80px !important;
}
}
</style>
<!-- End of bootstrap corrections -->
<style>
@media screen and (max-width: 767px) {
  body {
    padding-top: 11px;
  }
}
@media screen and (min-width: 768px) and (max-width: 1199px){
  body {
    padding-top: 60px;
  }
}
@media screen and (min-width: 1200px){
  body {
    padding-top: -80px !important;
  }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.6.1/fingerprint2.min.js" integrity="sha256-goBybI2a+FUEO9n1gkRyIYOwLPq6fO8z192AxA9O54I=" crossorigin="anonymous"></script>

</head>

<body class="nav-md">
	<link rel="stylesheet" href="/users/css/jquery-ui.min.css">
<link rel="stylesheet" href="/users/css/timepicker.css">
<script src="/users/js/jquery-ui.min.js"></script>
<script src="/users/js/timepicker.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" integrity="sha256-YsJ7Lkc/YB0+ssBKz0c0GTx0RI+BnXcKH5SpnttERaY=" crossorigin="anonymous" />
	<style>
	.editableform-loading {
	    background: url('https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/img/loading.gif') center center no-repeat !important;
	}
	.editable-clear-x {
	   background: url('https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/img/clear.png') center center no-repeat !important;
	}
	</style>
<nav class="custom-top bg-info">
<div class="container">
<div class="row justify-content-between">
    <div class="col-lg-3">
    	<a class="text-white" href="tel:99161XXX"> <i class="fa fa-phone fa-2x" aria-hidden="true"></i> <strong style="font-size:16px;"> +91 9916XXX</strong></a>
    </div>
    <div class="col-lg-4 d-none d-sm-block">
    	<ul class="footer-social" style="float:right;">
			<li><a class="facebook" href=""><i class="lni-facebook-filled"></i></a></li>
			<li><a class="twitter" href=""><i class="lni-twitter-filled"></i></a></li>
			<li><a class="linkedin" href=""><i class="lni-linkedin-fill"></i></a></li>
			<li><a class="instagram" href=""><i class="lni-instagram"></i></a></li>
			<li><a class="envelope" href=""><i class="lni-envelope"></i></a></li>

	</ul>
    </div>
  </div>
</div>
</nav>

<div class="page-header" style="background: url(../../assets/img/banner1.jpg);margin:0px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Reset Password</h2>
               <ol class="breadcrumb">
                  <li><a href="index.php">Home </a></li>
                  <li class="current">Reset Password</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $output; ?>

<?php
    include("footer.php");
?>
