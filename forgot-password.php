<?php
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
               <h2 class="product-title">Forgot Password</h2>
               <ol class="breadcrumb">
                  <li><a href="/index.php">Home /</a></li>
                  <li class="current">Forgot Password</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="section-padding">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-12 col-xs-12">
            <div class="forgot login-area">

               <form role="form" class="login-form" action="forgot-password-process.php" method="POST">
                  <div class="form-group">
                     <div class="input-icon">
                        <i class="icon lni-user"></i>
                        <input type="email" id="sender-email" class="form-control" name="email" placeholder="Email" required>
                     </div>
                  </div>
                  <div class="text-center">
                     <input type="submit" name="forgotten_password" class="btn btn-common log-btn" value="Reset Password" />
                  </div>
                  <div class="form-group mt-4">
                     <ul class="form-links">
                        <li class="float-left"><a href="signup.php">Don't have an account?</a></li>
                        <li class="float-right"><a href="login.php">Back to Login</a></li>
                     </ul>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
    include("footer.php");
?>
