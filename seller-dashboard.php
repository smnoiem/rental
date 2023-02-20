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
        if($_SESSION['user_type']==2){
            $adQ = "SELECT * FROM ads WHERE users_id='$users_id' ";
            $adResult = mysqli_query($db,$adQ);
            //$adRow = mysqli_fetch_array($adResult, MYSQLI_ASSOC);

            $catArr = [];
            $catQ = "SELECT * FROM category";
            $catResult = mysqli_query($db,$catQ);
            while($catRow = mysqli_fetch_array($catResult, MYSQLI_ASSOC)){
                $ind = $catRow['id'];
                $catArr[$ind] = $catRow['category'];
            }

            $subCatArr = [];
            $subCatQ = "SELECT * FROM subcategory";
            $subCatResult = mysqli_query($db,$subCatQ);
            while($subCatRow = mysqli_fetch_array($subCatResult, MYSQLI_ASSOC)){
                $ind = $subCatRow['id'];
                $subCatArr[$ind] = $subCatRow['subcategory'];
            }
        }
        else if($_SESSION['user_type']==1) header("Location: /admin-dashboard.php");
    }
    else header("Location: /index.php");
    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Seller Dashboard</h2>
               <ol class="breadcrumb">
                  <li><a href="/index.php">Home /</a></li>
                  <li class="current">Seller Dashboard</li>
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
                      <a href="seller-edit-profile.php?id=<?= $row['users_id']; ?>">
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
                     <h2 class="dashbord-title">Dashboard</h2>
                  </div>
                  <div class="dashboard-wrapper">
                     <div class="dashboard-sections">
                        <!--<div class="row">
                           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <div class="dashboardbox">
                                 <div class="icon"><i class="lni-write"></i></div>
                                 <div class="contentbox">
                                    <h2><a href="#">Total Ad Posted</a></h2>
                                                                        <h3>1 Add Posted</h3>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <div class="dashboardbox">
                                 <div class="icon"><i class="lni-support"></i></div>
                                 <div class="contentbox">
                                    <h2><a href="#">Messages</a></h2>
                                    <h3>0 Messages</h3>
                                 </div>
                              </div>
                           </div>
                        </div>-->
                     </div>
                     <table class="table table-responsive dashboardtable tablemyads">

                        <thead>
                           <tr>
                              <!--<th>
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkedall">
                                    <label class="custom-control-label" for="checkedall"></label>
                                 </div>
                              </th>-->
                              <th>Photo</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Sub Category</th>
                              <th>Ad Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <?php
                            if(mysqli_num_rows($adResult)==0){
                                echo("
                                    <tbody>
                                        <tr data-category=\"inactive\">
                                            <td>No Product</td>
                                        </tr>
                                    </tbody>
                                ");
                            }
                            else{
                                echo("<tbody>");
                                while($adRow = mysqli_fetch_array($adResult, MYSQLI_ASSOC)){
                                    $catInd = $adRow['category'];
                                    $subCatInd = $adRow['sub_category'];
                                    //var_dump($adRow);
                                    if($adRow['status']=="active") $adstatus = "
                                        <td data-title=\"Ad Status\">
                                            <a href=\"./seller-product-update-status.php?id=$adRow[id]&type=INACT\">
                                                <span class=\"adstatus adstatusactive\">active</span>
                                            </a>
                                        </td>";
                                    else $adstatus = "
                                        <td data-title=\"Ad Status\">
                                            <a href=\"./seller-product-update-status.php?id=$adRow[id]&type=ACT\">
                                                <span class=\"adstatus adstatussold\">Inactive</span>
                                            </a>
                                        </td>
                                    ";




                                    echo("
                                    <tr data-category=\"active\">
		                              <!--<td>
		                                 <div class=\"custom-control custom-checkbox\">
		                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"adone\">
		                                    <label class=\"custom-control-label\" for=\"adone\"></label>
		                                 </div>
		                              </td>-->
		                              <td class=\"photo\"><img class=\"img-fluid\"
			                              		src=\"./post_images/$adRow[image]\" alt=\"\"></td>
		                              <td data-title=\"Title\">
		                                 <h3>$adRow[title]</h3>
		                                 <span>$adRow[details]</span>
		                              </td>
		                              <td data-title=\"Category\"><span class=\"adcategories\">$catArr[$catInd]</span></td>
		                              <td data-title=\"SubCategory\">
		                              	<span class=\"adcategories\">$subCatArr[$subCatInd]</span>
		                              </td>
		                              $adstatus
		                              <td data-title=\"Action\">
		                                 <div class=\"btns-actions\">
		                                   <a class=\"btn-action btn-edit\" href=\"./seller-edit-post.php?id=$adRow[id]\"><i class=\"lni-pencil\"></i></a>
		                                    <a class=\"btn-action btn-delete\" href=\"./product-delete.php?id=$adRow[id]\"><i class=\"lni-trash\"></i></a>
		                                 </div>
		                              </td>
		                           </tr>
                                ");
                                }
                                echo("</tbody>");
                            }
                         ?>




                            <!--
                            <tbody>
                            <tr data-category="active">
		                              <!--<td>
		                                 <div class="custom-control custom-checkbox">
		                                    <input type="checkbox" class="custom-control-input" id="adone">
		                                    <label class="custom-control-label" for="adone"></label>
		                                 </div>
		                              </td>-->

		                              <!--
		                              <td class="photo"><img class="img-fluid"
			                              		src="./post_images/<?php //$adRow['image']; ?>" alt=""></td>
		                              <td data-title="Title">
		                                 <h3><?php //$adRow["title"]; ?></h3>
		                                 <span>Brand New Bata Power Shoe</span>
		                              </td>
		                              <td data-title="Category"><span class="adcategories">Apparel & Jewellery</span></td>
		                              <td data-title="SubCategory">
		                              	<span class="adcategories">Men's Dresses</span>
		                              </td>
		                              <td data-title="Ad Status">
		                              	<a href="./seller-product-update-status.php?id=168&type=INACT">
		                              		<span class="adstatus adstatusactive">active</span>
		                              	</a>
		                              </td>
		                              <td data-title="Action">
		                                 <div class="btns-actions">
		                                   <a class="btn-action btn-edit" href="./seller-edit-post.php?id=168"><i class="lni-pencil"></i></a>
		                                    <a class="btn-action btn-delete" href="./product-delete.php?id=168"><i class="lni-trash"></i></a>
		                                 </div>
		                              </td>
		                           </tr>
                            </tbody>
                            -->






                     </table>
                  </div>
               </div>
            </div>
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
