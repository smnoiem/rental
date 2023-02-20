<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==1) {
        $users_id = $_SESSION['id'];
        $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
        $result = mysqli_query($db,$sellerQ);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($_SESSION['user_type']==1){
            $catQ = "SELECT * FROM category ORDER BY category";
            $catResult = mysqli_query($db,$catQ);

/*
            $subCatArr = [];
            $subCatQ = "SELECT * FROM subcategory";
            $subCatResult = mysqli_query($db,$subCatQ);
            while($subCatRow = mysqli_fetch_array($subCatResult, MYSQLI_ASSOC)){
                $ind = $subCatRow['id'];
                $subCatArr[$ind] = $subCatRow['subcategory'];
            }
*/
        }
    }
    else header("Location: /index.php");
    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Site Categories</h2>
               <ol class="breadcrumb">
                  <li><a href="/index.php">Home /</a></li>
                  <li class="current">Site Categories</li>
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
           <a href="seller-edit-profile.php?id=<?= $row['users_id']; ?>">
           <i class="lni-enter"></i>
           <span>Edit Profile</span>
           </a>
        </li>
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
                     <h2 class="dashbord-title">Categories</h2>
                  </div>
                  <div class="dashboard-wrapper">
                     <div class="dashboard-sections">
                     </div>

                         <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="row page-content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                  <div class="inner-box">
                     <div class="dashboard-box">
                        <h2 class="dashbord-title">Add New Category</h2>
                     </div>
                     <div class="dashboard-wrapper">
        		      <form action="add-category-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return uploadvalidateform()">
                        <div class="form-group mb-3">
                           <label class="control-label">Category Name:</label>
                           <input class="form-control input-md" name="name" placeholder="category" type="text" required>
                        </div>


                        <div class="form-group mb-3">
	                        <label class="tg-fileuploadlabel" for="tg-photogallery">
	                        <img style="background-color:#00b8e6" id="preview_img" src="assets/img/noimage.png" />
	                        <div id="message" style="text-align: center;"></div>
	                        <span>Category Icon Upload</span>
	                        <span>Or</span>
	                        <span class="btn btn-common">Select Files</span>
	                        <span>Maximum upload file size: 150 KB</span>
	                        <input id="tg-photogallery" class="tg-fileinput" type="file" name="img_file" id="img_file" onchange="showPreview(event)" />
	                        </label>
	                        <button class="btn btn-common" type="submit" name="submit">Insert Category</button>
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


                         <div class="dashboard-box">
                            <h2 class="dashbord-title">Existing Categories</h2>
                         </div>
                     <table class="table table-responsive dashboardtable tablemyads">

                        <thead>
                           <tr>
                              <th>Icon</th>
                              <th>Category</th>
                              <th>keyword</th>
                              <th>Sub Category</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <?php
                            if(mysqli_num_rows($catResult)==0){
                                echo("
                                    <tbody>
                                        <tr data-category=\"inactive\">
                                            <td>No Category</td>
                                        </tr>
                                    </tbody>
                                ");
                            }
                            else{
                                echo("

                                    <tbody>

                                    ");
                                while($catRow = mysqli_fetch_array($catResult, MYSQLI_ASSOC)){
                                    $catInd = $catRow['id'];
                                    //var_dump($adRow);

                                    echo("
                                    <tr data-category=\"active\">
		                              <td class=\"icon\" style=\"background-color:#00b8e6\"><img class=\"img-fluid\"
			                              		src=\"./assets/img/category/$catRow[icon]\" alt=\"no icon\"></td>
		                              <td data-title=\"Title\">
		                                 <h3>$catRow[category]</h3>
		                              </td>
		                              <td data-title=\"Category\"><span class=\"adcategories\">$catRow[catkey]</span></td>
		                              <td data-title=\"SubCategory\">
		                              	  <a class=\"btn-action btn-edit\" href=\"./show-subcategory.php?id=$catRow[id]\">Show Subcategories</a>
		                              </td>
		                              <td data-title=\"Action\">
		                                 <div class=\"btns-actions\">
		                                   <a class=\"btn-action btn-edit\" href=\"./edit-category.php?id=$catRow[id]\"><i class=\"lni-pencil\"></i></a>
		                                    <a class=\"btn-action btn-delete\" href=\"./category-delete.php?id=$catRow[id]\"><i class=\"lni-trash\"></i></a>
		                                 </div>
		                              </td>
		                           </tr>
                                ");
                                }
                                echo("</tbody>");
                            }
                         ?>


                     </table>
                  </div>
               </div>
            </div>
         </div>


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
