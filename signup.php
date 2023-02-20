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
               <h2 class="product-title">Join Us</h2>
               <ol class="breadcrumb">
                  <li><a href="/index.php">Home /</a></li>
                  <li class="current">Register</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="register section-padding">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-12 col-xs-12">
            <div class="register-form login-area">
               <h3>
                  Register
               </h3>
               <form class="login-form" action="signup-process.php" method="POST">

               	<div class="form-group">
                     <div class="input-icon">
                        <i class="lni-envelope"></i>
                        <input type="email" id="sender-email" class="form-control" name="email" placeholder="Email Address" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-lock"></i>
                        <input type="password" name="confirm" class="form-control" placeholder="Retype Password" required>
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-user"></i>
                        <input type="text" id="FName" class="form-control" name="fname" placeholder="First Name" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="input-icon">
                        <i class="lni-user"></i>
                        <input type="text" id="LName" class="form-control" name="lname" placeholder="Last Name" required>
                     </div>
                  </div>

                  <input type="hidden" id="token" name="token" >


                  <div class="form-group mb-3">
                     <div class="checkbox">
                        <input type="checkbox" name="agreement_checkbox" required />
                        <label>By registering, you accept our Terms & Conditions</label>
                     </div>
                  </div>
                  <div class="text-center">
                     <button type="submit" class="btn btn-common log-btn" name="post">Register</button>
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
