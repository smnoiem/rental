<?php
    include("conn.php");
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    session_start();
    session_destroy();
    if(isset($_POST['email'])) {
        $email= $_POST['email'];
        $usQ = "SELECT * FROM users WHERE email='$email'";
        $usR = mysqli_query($db, $usQ);
        if(mysqli_num_rows($usR)>0){
            $usRow=mysqli_fetch_array($usR, MYSQLI_ASSOC);
            if(isset($usRow['fname'])) $name = $usRow['fname'];
            else $name = "";
            $tok = md5(3968*2+$email);
           $substr = substr(md5(uniqid(rand(),1)),3,10);
           $token = $tok . $substr;
           $expFormat = mktime(
                date("H"), date("i")+90, date("s"), date("m") ,date("d"), date("Y")
           );
           $expDate = date("Y-m-d H:i:s",$expFormat);
           $tokenQ="UPDATE users SET token = '$token', token_exp = '$expDate' WHERE email='$email'";
            if(mysqli_query($db, $tokenQ)){
                $to = $email;
                $subject = "Quickon Rentals - Reset Password";
                $headers = "From: Quickon Rentals < info@quickonrentals.com >\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $txt = "
                    Hello $name,
                    <br>
                    You are receiving this email because a request was made to reset your password. If this was not you, you may disregard this email.
                    <br>
                    If this was you, click the link below to continue with the password reset process.
                    <br>
                    <a href=\"http://quickonrentals.com/forgot-password-reset.php?email=$email&vericode=$token\" >Reset Password</a>
                    <br>
                    Sincerely,
                    <br>
                    -Quickon Team-
                    <br>
                    <small>Please note, Password links expire in 90 minutes.</small>
                    ";

                if(mail($to,$subject,$txt,$headers)){
                    $note="
                        <div class=\"alert alert-success\">
                             Check email for password reset link.
                        </div>
                    ";
                }
                else{
                    $note="
                        <div class=\"alert alert-danger\">
                             There is a problem with sending email.
                        </div>
                    ";
                }



            }
            else{
                $note="
                    <div class=\"alert alert-danger\">
                         There is a problem with database update.
                    </div>
                ";
            };

        }
        else {
            $note="
                <div class=\"alert alert-danger\">
                     That email does not exist in our database.
                </div>
            ";
        }
    }
    else $note="
        <div class=\"alert alert-danger\">
             No email given.
        </div>
    ";
    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Forgot Password</h2>
               <ol class="breadcrumb">
                  <li><a href="#">Home /</a></li>
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
            <?= $note; ?>
        </div>
      </div>
   </div>
</section>



<?php
    include("footer.php");
?>
