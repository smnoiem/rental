<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_SESSION['id'])) {
        $users_id = $_SESSION['id'];
        $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
        $result = mysqli_query($db,$sellerQ);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    else header("Location: /index.php");
    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Post you Ads</h2>
               <ol class="breadcrumb">
                  <li><a href="#">Home /</a></li>
                  <li class="current">Post you Ads</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="content" class="section-padding">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
            <aside>
            	<div class="sidebar-box">
  <div class="user">
     <figure>
        <a href="#"><img src="./user_images/<?= $row['image']; ?>" width="64px" height="64px" alt=""></a>
     </figure>
     <div class="usercontent">
        <h3><?= $row['bname']; ?></h3>
        <h4>Seller Dashboard</h4>
     </div>
  </div>
  <nav class="navdashboard">
     <ul>
        <li>
           <a href="seller-dashboard.php">
           <i class="lni-dashboard"></i>
           <span>Main Dashboard</span>
           </a>
        </li>
        <li>
           <a class="active" href="seller-new-post-upload.php">
           <i class="lni-layers"></i>
           <span>Add My New Ads</span>
           </a>
        </li>
        <li>
                      <a href="seller-edit-profile.php?id=<?= $users_id ?>">
           <i class="lni-enter"></i>
           <span>Edit Profile</span>
           </a>
        </li>
       <!-- <li><a href="change-password.php"><i class="lni-enter"></i>Change Password</a></li>-->
        <li>
           <a href="./logout.php">
           <i class="lni-enter"></i>
           <span>Logout</span>
           </a>
        </li>
     </ul>
  </nav>
</div>            </aside>
         </div>
         <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="row page-content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                  <div class="inner-box">
                     <div class="dashboard-box">
                        <h2 class="dashbord-title">Seller Post Detail</h2>
                     </div>
                     <div class="dashboard-wrapper">
        		      <form action="seller-product-upload-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return uploadvalidateform()">
                        <div class="form-group mb-3">
                           <label class="control-label">Product Title</label>
                           <input class="form-control input-md" name="name" placeholder="Title" type="text" required>
                        </div>
                        <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Select Category</label>
                           <div class="tg-select form-control">
                              <select name="cat" id="search_cat" onchange='setSubCat(this.value);' required>
                                 <option value="0">Select Category</option>
                                 <?php
                                    $catQ = "SELECT * FROM category";
                                    $catR = mysqli_query($db,$catQ);
                                    while($catRow = mysqli_fetch_array($catR, MYSQLI_ASSOC)){
                                        echo("
                                         <option value=\"$catRow[id]\">$catRow[category]</option>
                                        \n");
                                    }
                                ?>

                              </select>
                           </div>
                        </div>
                        <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Select Sub Category</label>
                           <div class="tg-select form-control">
                              <select name="subcat" id='subcat_home_options' required>
                                 <option value="0">Select Sub Category</option>
                                 <?php
                                    $subCatQ = "SELECT * FROM subcategory";
                                    $subCatR = mysqli_query($db,$subCatQ);
                                    while($subCatRow = mysqli_fetch_array($subCatR, MYSQLI_ASSOC)){
                                        echo("
                                         <option value=\"$subCatRow[id]\">$subCatRow[subcategory]</option>
                                        \n");
                                    }
                                ?>
                              </select>
                           </div>
                        </div>

                        <?php

                            echo("<script>\n
                                var subcat_array = [");

                                    $subCatQ = "SELECT * FROM subcategory";
                                    $subCatR = mysqli_query($db,$subCatQ);
                                    while($subCatRow = mysqli_fetch_array($subCatR, MYSQLI_ASSOC)){
                                        echo("
                                        [\"$subCatRow[id]\",\"$subCatRow[cat_id]\",\"$subCatRow[subcategory]\"],
                                        \n");
                                    }

                            echo("
                                ];
                                function setSubCat(cat) {
                                    cat = parseInt(cat);
                                    var opt_str = \"<option value=\\\"0\\\">No Sub-Categories</option>\";
                                    for(var i in subcat_array) {
                                         var id = parseInt(subcat_array[i][0]);
                                         var category = parseInt(subcat_array[i][1]);
                                         var name = subcat_array[i][2];
                                         if(cat == category || cat==0) {
                                            opt_str = opt_str+\"<option value='\"+id+\"'>\"+name+\"</option>\";
                                         }
                                    }
                                    $('#subcat_home_options').html(opt_str);
                                    $('#subcat_home_options').focus();

                                };
                            </script>");
                        ?>

		                 <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Select Location</label>
                           <div class="tg-select form-control">
                              <select name="location" id='search_loc' required>
                                 <option value="0">Select Location</option>
                					<option value='1'>Guwahati</option><option value='2'>Bangalore</option><option value='3'>Chennai</option><option value='4'>Mumbai</option><option value='5'>Delhi</option><option value='6'>Hyderabad</option><option value='7'>Kolkata</option><option value='8'>Pune</option><option value='10'>Mysore</option><option value='11'>Vishakapatnam</option><option value='12'>Surat</option><option value='13'>Ahmedabad</option><option value='14'>Patna</option><option value='15'>Kanpur</option><option value='16'>Vijayawada</option><option value='17'>Jamshedpur</option>                              </select>
                           </div>
                        </div>

                        <div class="form-group mb-3">
                           <label class="control-label">Brief Product Details (Optional) </label>
                           <textarea name="description" rows="3" cols="55">
                           </textarea>
                        </div>
                        <div class="form-group mb-3">
	                        <label class="tg-fileuploadlabel" for="tg-photogallery">
	                        <img id="preview_img" src="assets/img/noimage.png" />
	                        <div id="message" style="text-align: center;"></div>
	                        <span>Product image upload</span>
	                        <span>Or</span>
	                        <span class="btn btn-common">Select Files</span>
	                        <span>Maximum upload file size: 500 KB</span>
	                        <input id="tg-photogallery" class="tg-fileinput" type="file" name="img_file" id="img_file" onchange="showPreview(event)" />
	                        </label>
	                        <button class="btn btn-common" type="submit" name="submit">Post Ad</button>
	               </div>
	               </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	function uploadvalidateform() {
		cat = $("#search_cat").val();
		subcat = $("#subcat_home_options").val();
		loc = $("#search_loc").val();
		if(cat==0 || subcat==0 || loc==0) {
			alert("Please select valid options.");
			return false;
		}
		img = $("#img_file").val();
		if(img=='') {
			alert("Please upload an image.");
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
