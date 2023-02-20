<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_GET['id'])&&isset($_SESSION['id'])){
        $seller = $_GET['id'];
        $logged  = $_SESSION['id'];
        if($seller!=$logged) {
            header("Location: seller-dashboard.php");
        }
        else {
            //query
            $users_id = $_SESSION['id'];
            $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
            $result = mysqli_query($db,$sellerQ);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
    else header("Location: seller-dashboard.php");
    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Upgrade Account</h2>
               <ol class="breadcrumb">
                  <li><a href="#">Home /</a></li>
                  <li class="current">Upgrade to seller account</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="content" class="section-padding">
   <div class="container">
      <div class="row">
        <div class="dashboard-box" style="margin-bottom: 15px;">
          <h2 class="dashbord-title">Business Detail</h2>
        </div>
        <form action="seller-edit-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return validateform()">
         <div class="col-sm-12 col-md-8 col-lg-10 col-offset-lg-1">
            <div class="row page-content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="inner-box">
                     <div class="dashboard-wrapper">
                        <div class="form-group mb-3">
                           <label class="control-label">Business Name*</label>
                           <input class="form-control input-md" name="bname" placeholder="Business Name" value="<?= $row['bname'] ?>"  type="text" required>
                        </div>
                        <div class="form-group mb-3">
                           <label class="control-label">E-mail*</label>
                           <input class="form-control input-md" name="bemail" placeholder="Business E-Mail" value="<?= $row['email'] ?>" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                         <div class="form-group mb-3">
                           <label class="control-label">Phone*</label>
                           <input class="form-control input-md" name="phone" placeholder="Enter Your 10 Digit Number" value="<?= $row['phone'] ?>"  type="tel" pattern="[6789][0-9]{9}" required>
                        </div>
                        <div class="form-group mb-3">
                           <label class="control-label">Alternate Number</label>
                           <input class="form-control input-md" name="altphone" placeholder="Enter Your 10 Digit Number" value="<?= $row['aphone'] ?>"  pattern="[6789][0-9]{9}" type="tel">
                        </div>
                        <div class="form-group mb-3">
                           <label class="control-label">Date of Establishment</label>
                           <input class="form-control input-md" name="est" type="date"  value="<?= $row['estab'] ?>" >
                        </div>
                        <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Location</label>
                           <div class="tg-select form-control">
                              <select name="location" id="location">
                                    <option value=0 >Select Location</option>
                                    <?php
                                        $locQ = "SELECT * FROM location";
                                        $result2 = mysqli_query($db,$locQ);
                                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                            $selected = "";
                                            if($row['location']==$row2['id']) $selected = "selected";
                                            echo("<option value=$row2[id] $selected>$row2[location]</option>\n");
                                        }

                                    ?>
                               </select>
                           </div>
                        </div>

                        <div class="form-group mb-3">
                           <label class="control-label">Address*</label>
                           <input class="form-control input-md" name="address" type="text" required value="<?= $row['address'] ?>" >
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="inner-box">
                     <div class="dashboard-wrapper">
                        <div class="form-group mb-3">
                           <label class="control-label">Website (if available)</label>
                           <input class="form-control input-md" name="website" placeholder="website name" value="<?= $row['website'] ?>"  type="text">

                        </div>


                        <input class="form-control input-md" name="defaultImg" placeholder="website name" value=""  type="hidden">

                        <div class="form-group md-3">
                           <label class="control-label">GSTIN (if available)</label>
                           <input class="form-control input-md" name="gstin" placeholder="GST number" value="<?= $row['gstin'] ?>" >
                        </div>
                        <div class="form-group md-3 tg-inputwithicon">

                           <label class="control-label">Select Plan</label>
            				<div class="tg-select form-control">
            				<select name="plan">
            				<option value="trial" <?php if($row['plan']=="trial") echo("selected"); ?>>Trial</option>
            				<option value="silver" <?php if($row['plan']=="silver") echo("selected"); ?>>Silver</option>
            				<option value="gold" <?php if($row['plan']=="gold") echo("selected"); ?>>Gold</option>
            				<option value="platinum" <?php if($row['plan']=="platinum") echo("selected"); ?>>Platinum</option>
            				</select>
            				</div>
                        </div>

	                        <label class="tg-fileuploadlabel" for="tg-photogallery">
	                        <img id="preview_img" src="/user_images/<?= $row['image'] ?>" width="64px" height="64px" alt="" />
	                        <div id="message" style="text-align: center;"></div>
	                        <span>Product image upload</span>
	                        <span>Or</span>
	                        <span class="btn btn-common">Select Files</span>
	                        <span>Maximum upload file size: 500 KB</span>
	                        <input id="tg-photogallery" class="tg-fileinput" type="file" name="img_file" id="img_file" onchange="showPreview(event)">
	                        </label>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
	             <div class="form-group md-3">
		           <button class="btn btn-common" type="submit" name="submit">Update</button>
		       </div>
	            </div>
	       </div>
	       </form>
         </div>
      </div>
   </div>
</div>
<script>
    function validateform() {
        loc = $("#location").val();
        if(loc==0) {
            alert("Select location");
            return false;
        }
        img = $("#img_file").val();
        if(img=='') {
            alert("Upload image");
            return false;
        }
        return true;
    }
	function showPreview(event) {
			$("#message").empty(); // To remove the previous error message
			var mfile = event.target.files[0];
			var imagefile = mfile.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				$('#preview_img').attr('src','assets/img/errorimage.png');
				$("#message").html("<p id='error'>Please Select A valid Image File</p><span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
				$("#img_file").val('');
				return false;
			} else if(mfile.size > 500000) {
				$('#preview_img').attr('src','assets/img/errorimage.png');
				$("#message").html("<p id='error'>The uploaded file is too large</p><span id='error_message'>You can upload upto 500 kB.</span>");
				$("#img_file").val('');
				return false;

			} else {
				var reader = new FileReader();
				reader.onload = postImageLoad;
				reader.readAsDataURL(event.target.files[0]);
			}
	}
	function postImageLoad(e) {
		//$("#file1").css("color","green");
		//$('#image_preview1').css("display", "block");
		$('#preview_img').attr('src', e.target.result);
		$('#preview_img').attr('width', '225px');
		$('#preview_img').attr('height', '225px');
	};
</script>
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
