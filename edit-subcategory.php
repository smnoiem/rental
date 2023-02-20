<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_GET['id'])&&isset($_GET['catid'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==1){
        $id = $_GET['id'];
        $catId = $_GET['catid'];

        $subcatQ = "SELECT * FROM subcategory WHERE id='$id' ";
        $subcatResult = mysqli_query($db,$subcatQ);
        $subcatCount = mysqli_num_rows($subcatResult);
        $subcatRow = mysqli_fetch_array($subcatResult, MYSQLI_ASSOC);

        $users_id = $_SESSION['id'];
        $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
        $result = mysqli_query($db,$sellerQ);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($subcatCount!=1){
            header("Location: show-subcategory.php?id=$catId");
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
               <h2 class="product-title">Edit Sub Category</h2>
               <ol class="breadcrumb">
                  <li><a href="/index.php">Home /</a></li>
                  <li class="current">Edit Sub Category</li>
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
        <h4>Admin Dashboard</h4>
     </div>
  </div>
  <nav class="navdashboard">
     <ul>
        <li>
           <a class="active" href="admin-dashboard.php">
           <i class="lni-dashboard"></i>
           <span>Main Dashboard</span>
           </a>
        </li>
        <li>
           <a href="show-category.php">
           <i class="lni-layers"></i>
           <span>Manage Categories</span>
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
            <div class="page-content">
               <div class="inner-box">
                  <div class="dashboard-box">
                     <h2 class="dashbord-title">Sub Categories</h2>
                  </div>
                  <div class="dashboard-wrapper">
                     <div class="dashboard-sections">
                     </div>

                         <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="row page-content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                  <div class="inner-box">
                     <div class="dashboard-box">
                        <h2 class="dashbord-title">Edit Sub Category</h2>
                     </div>
                     <div class="dashboard-wrapper">
        		      <form action="edit-subcategory-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return uploadvalidateform()">
                        <input class="form-control input-md" name="id" value="<?= $subcatRow['id']; ?>" type="hidden">

                        <div class="form-group mb-3">
                           <label class="control-label">Sub Category Name:</label>
                           <input class="form-control input-md" name="name" value="<?= $subcatRow['subcategory']; ?>" type="text" required>
                        </div>

                        <div class="form-group mb-3">
                           <label class="control-label">Sub Category Keyword (It is shown in the address bar):</label>
                           <input class="form-control input-md" name="subcatkey" value="<?= $subcatRow['subcatkey']; ?>" type="text" required>
                        </div>


	                        <button class="btn btn-common" type="submit" name="submit">Update</button>
	               </form>
                  </div>
               </div>
            </div>
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
		if(cat==0) {
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
			} else if(mfile.size > 150000) {
				$('#preview_img').attr('src','assets/img/errorimage.png');
				$("#message").html("<p id='error'>The uploaded file is too large</p><span id='error_message'>You can upload upto 150 kB.</span>");
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
