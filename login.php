<?php
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    include("header.php");
?>

<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Login</h2>
               <ol class="breadcrumb">
                  <li><a href="index.php">Home /</a></li>
                  <li class="current">Login</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="login section-padding">
   <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-5 col-md-12 col-xs-12">
        <?php if(isset($_GET['nomatch'])) if($_GET['nomatch']=="true"){ ?>
	    		<div class="alert alert-danger">
			<strong>Error!</strong> The username or password is invalid.
		</div>
		<?php } ?>
	                <div class="login-form login-area">
               <h3>
                  Customer Login
               </h3>
               <form role="form" class="login-form" action="login-process.php" method="post">
               	  <input type="hidden" name="dest" value="" />
                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="Email" autofocus required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-lock"></i>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                     </div>
                  </div>
                  <input type="hidden" id="token" name="token" >
                  <div class="form-group mb-3">
                     <div class="checkbox">
                        <input type="checkbox" name="remember" value="remember">
                        <label>Keep me logged in</label>
                     </div>
                     <p class="forgetpassword"><a href="forgot-password.php">Forgot Password?</a> | <a href="signup.php">Register Here</a>
                     <p>
                  </div>
                  <input type="hidden" name="csrf" value="2778d285e891a9a5a0d38d2bd3406699">
	          <input type="hidden" name="redirect" value="" />
                  <div class="text-center">
                     <button class="btn btn-common log-btn" type="submit" name="post" >Login</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
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
<?php
    include("footer.php");
?>
