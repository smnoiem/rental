<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_GET['id'])&&isset($_SESSION['id'])){
        $id = $_GET['id'];
        $adsQ = "SELECT * FROM ads WHERE id='$id' ";
        $adsResult = mysqli_query($db,$adsQ);
        $adsCount = mysqli_num_rows($adsResult);
        $adsRow = mysqli_fetch_array($adsResult, MYSQLI_ASSOC);

        $users_id = $_SESSION['id'];
        $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
        $result = mysqli_query($db,$sellerQ);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($adsCount!=1 || $adsRow['users_id']!=$_SESSION['id']){
            header("Location: seller-dashboard.php");
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
               <h2 class="product-title">Edit Ad</h2>
               <ol class="breadcrumb">
                  <li><a href="#">Home /</a></li>
                  <li class="current">Edit Ad Post</li>
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
           <a class="active" href="seller-dashboard.php">
           <i class="lni-dashboard"></i>
           <span>Main Dashboard</span>
           </a>
        </li>
        <li>
           <a href="seller-new-post-upload.php">
           <i class="lni-layers"></i>
           <span>Add My New Ads</span>
           </a>
        </li>
        <li>
                      <a href="seller-edit-profile.php?id=<?= $users_id; ?>">
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
        		        <form action="seller-product-edit-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return validateAdForm()">
                        <input name="id" value="<?= $adsRow['id'] ?>" type="text" style="display: none;">
                        <div class="form-group mb-3">
                           <label class="control-label">Product Title</label>
                           <input class="form-control input-md" name="name" value="<?= $adsRow['title'] ?>" type="text" required>
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
                                        $selected = "";
                                        if($adsRow['category']==$catRow['id']) $selected = "selected";
                                        echo("
                                         <option value=\"$catRow[id]\" $selected>$catRow[category]</option>
                                        \n");
                                    }
                                ?>

                            </select>

                            </div>
                        </div>
                        <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Select Sub Category</label>
                           <div class="tg-select form-control">
                              <select name="subcat" id='ad_subcat' required>
                                 <option value="0">Select Sub Category</option>
                				<?php
                                    $subCatQ = "SELECT * FROM subcategory";
                                    $subCatR = mysqli_query($db,$subCatQ);
                                    while($subCatRow = mysqli_fetch_array($subCatR, MYSQLI_ASSOC)){
                                        $selected = "";
                                        if($adsRow['sub_category']==$subCatRow['id']) $selected = "selected";
                                        echo("
                                         <option value=\"$subCatRow[id]\" $selected>$subCatRow[subcategory]</option>
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
                                         if(cat == category) {
                                            if(id==$adsRow[sub_category]) opt_str = opt_str+\"<option value='\"+id+\"' selected>\"+name+\"</option>\";
                                            else opt_str = opt_str+\"<option value='\"+id+\"'>\"+name+\"</option>\";
                                         }
                                    }
                                    $('#ad_subcat').html(opt_str);
                                    $('#ad_subcat').focus();

                                };
                            </script>");
                        ?>



                        <div class="form-group mb-3 tg-inputwithicon">
                           <label class="control-label">Select Location</label>
                           <div class="tg-select form-control">
                              <select name="location" id="ad_loc" required>
                                 <option value="0">Select Location</option>
                                    <?php
                                        $locQ = "SELECT * FROM location";
                                        $result2 = mysqli_query($db,$locQ);
                                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                            $selected = "";
                                            if($adsRow['location']==$row2['id']) $selected = "selected";
                                            echo("<option value=$row2[id] $selected>$row2[location]</option>\n");
                                        }

                                    ?>
                                </select>
            				</div>
                        </div>

                        <div class="form-group mb-3">
                           <label class="control-label">Brief Product Details (Optional) </label>
                           <textarea name="description" rows="3" cols="55"><?= $adsRow['details'] ?></textarea>
                        </div>
                        <div class="form-group mb-3">
	                        <label class="tg-fileuploadlabel" for="tg-photogallery">
	                        <img id="preview_img" src="post_images/<?= $adsRow['image'] ?>"  width="75px" height="75px" />
	                        <div id="message" style="text-align: center;"></div>
	                        <span>Product image upload</span>
	                        <span>Or</span>
	                        <span class="btn btn-common">Select Files</span>
	                        <span>Maximum upload file size: 500 KB</span>
	                        <input id="tg-photogallery" class="tg-fileinput" type="file" name="img_file" id="img_file" onchange="showPreview(event)">
	                        </label>
	                        <button class="btn btn-common" type="submit" name="submit">Update</button>
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

<script>
	function validateAdForm() {
		cat = $("#ad_cat").val();
		subcat = $("#ad_subcat").val();
		loc = $("#ad_loc").val();
		if(cat == 0|| subcat==0 || loc==0) {
			alert("Please select valid options for all fields.");
			return false;
		}
		return true;
	}
	$( document ).ready(function() {
        setSubCat(<?= $adsRow['category']; ?>);
        document.getElementById('ad_subcat').value = '<?= $adsRow['sub_category']; ?>';
    });

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
