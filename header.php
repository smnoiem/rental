<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="msvalidate.01" content="" />

	<link rel="manifest" href="manifest.json">


            

            <title><?= $metaTitle; ?></title>
	        <meta name="title" content="<?= $metaTitle; ?>">
	        <meta name="description" content="<?= $metaDescription; ?>"/>
            <meta name="keywords" content="<?= $metaTags; ?>">
            
            <meta name="google-site-verification" content="8vrrGnVRDfO2p8T4VBmUtzksP1Z1CZI1ZshJDJ2II-4" />

            
    <link rel="canonical" href="<?= $canonicalUrl; ?>">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/fonts/line-icons.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/slicknav.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/nivo-lightbox.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
	<link rel="shortcut icon" type="image/png" href="/assets/favicon.ico"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="/assets/js/jquery-min.js"></script>





</head>
<body>





	<header id="header-wrap">
	<script type="text/javascript">
	$( document ).ready(function() {
		$(function(){
			// this will get the full URL at the address bar
			var url = window.location.href;

			// passes on every "a" tag
			$(".menu a").each(function() {
					// checks if its the same on the address bar
				if(url == (this.href)) {
					$('.menu a').removeClass("active");
					$(this).closest(".menu a").addClass("active");
				}
			});
		});
	});
	</script>
<nav class="custom-top bg-info">
<div class="container">
<div class="row justify-content-between">
    <div class="col-lg-3">
    	<a class="text-white" href="tel:6362328251"> <i class="fa fa-phone fa-2x" aria-hidden="true"></i> <strong style="font-size:16px;"> +91 6362328251</strong></a>
    </div>
    <div class="col-lg-4 d-none d-sm-block">
    	<ul class="footer-social" style="float:right;">
			<li><a class="facebook" href="https://www.facebook.com/"><i class="lni-facebook-filled"></i></a></li>
			<li><a class="twitter" href="https://twitter.com/"><i class="lni-twitter-filled"></i></a></li>
			<li><a class="linkedin" href="https://www.linkedin.com/"><i class="lni-linkedin-fill"></i></a></li>
			<li><a class="instagram" href="https://www.instagram.com/"><i class="lni-instagram"></i></a></li>
			<li><a class="envelope" href="mailto:mail@yourmail.com"><i class="lni-envelope"></i></a></li>

	</ul>
    </div>
  </div>
</div>
</nav>



<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar" style="top:54px;">
<div class="container">

<div class="navbar-header">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
</button>
<a href="/index.php" class="navbar-brand"><img src="/assets/img/logo1.png" alt="Logo"></a>
</div>
<div class="collapse navbar-collapse" id="main-navbar">


<ul class="sign-in ml-auto">
    <li class="nav-item dropdown">

    <?php if(!isset($_SESSION['id'])): ?>
        <a class="nav-link dropdown-toggle" href="/login.php">
			<i class="lni-user"></i> Login/Register
		</a>
    <?php endif; ?>
        <?php if(isset($_SESSION['id'])): ?>
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="lni-user"></i> <?php echo("$_SESSION[fname] $_SESSION[lname]"); ?></a>
            <div class="dropdown-menu">

                <?php
                if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==1)
                    echo("<a class=\"dropdown-item\" href=\"/admin-dashboard.php\"><i class=\"lni-cog\"></i> Admin Dashboard</a>");
                else echo("<a class=\"dropdown-item\" href=\"/seller-register.php\"><i class=\"lni-cog\"></i> Seller Dashboard</a>");
                ?>


                <a class="dropdown-item" href="/logout.php"><i class="lni-lock"></i> Logout</a>
            </div>
        <?php endif; ?>
    </li>

</ul>
</div>

</div>


<?php if(!isset($_SESSION['id'])): ?>
<ul class="mobile-menu">
			<li><a class="active" href="/login.php">
				<i class="lni-user"></i> <strong>Login/Registration</strong>
			</a></li>
</ul>
<?php endif; ?>
<?php if(isset($_SESSION['id'])): ?>
<ul class="mobile-menu">
			<li><a class="active" href="#">
				<i class="lni-user"></i> <strong><?php echo("$_SESSION[fname] $_SESSION[lname]"); ?></strong>
			</a><li>
			<li><a href="/seller-register.php"><i class="lni-cog"></i> Seller Dashboard</a></li>
			<li><a href="/logout.php"><i class="lni-lock"></i> Logout</a></li>
</ul>
<?php endif; ?>

</nav>
</header>
