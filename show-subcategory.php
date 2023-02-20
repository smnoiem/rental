<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_GET['id'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==1) {
        $catId = $_GET['id'];
        $users_id = $_SESSION['id'];
        $sellerQ = "SELECT * FROM sellers WHERE users_id='$users_id' ";
        $result = mysqli_query($db,$sellerQ);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($_SESSION['user_type']==1){

            $catQ = "SELECT * FROM category WHERE id=$catId";
            $catResult = mysqli_query($db,$catQ);
            if(mysqli_num_rows($catResult)!=1){
                header("Location: /show-category.php");
            }
            else $catRow = mysqli_fetch_array($catResult, MYSQLI_ASSOC);

            $subcatQ = "SELECT * FROM subcategory WHERE cat_id=$catId ORDER BY subcategory";
            $subcatResult = mysqli_query($db,$subcatQ);

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
               <h2 class="product-title">Sub-Categories of <?= $catRow['category']; ?></h2>
               <ol class="breadcrumb">
                  <li><a href="/show-category.php">Manage Category /</a></li>
                  <li class="current">Sub Categories</li>
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
                     <h2 class="dashbord-title"><?= $catRow['category']; ?></h2>
                  </div>
                  <div class="dashboard-wrapper">
                     <div class="dashboard-sections">
                     </div>

                         <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="row page-content">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                  <div class="inner-box">
                     <div class="dashboard-box">
                        <h2 class="dashbord-title">Add New Sub-Category</h2>
                     </div>
                     <div class="dashboard-wrapper">
        		        <form action="add-subcategory-process.php" method="POST"  enctype="multipart/form-data" onsubmit="return uploadvalidateform()">
                            <input class="form-control input-md" name="catid" type="hidden" value="<?= $catId; ?>">
                            <div class="form-group mb-3">
                               <label class="control-label">Sub-Category Name:</label>
                               <input class="form-control input-md" name="name" placeholder="sub-category" type="text" required>
                            </div>
	                        <button class="btn btn-common" type="submit" name="submit">Insert Sub-Category</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



                         <div class="dashboard-box">
                            <h2 class="dashbord-title">Existing Categories</h2>
                         </div>
                     <table class="table table-responsive dashboardtable tablemyads">

                        <thead>
                           <tr>
                              <th>Sub Category</th>
                              <th>keyword</th>
                              <th>Parent Category</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <?php
                            if(mysqli_num_rows($subcatResult)==0){
                                echo("
                                    <tbody>
                                        <tr data-category=\"inactive\">
                                            <td>No Sub Category</td>
                                        </tr>
                                    </tbody>
                                ");
                            }
                            else{
                                echo("

                                    <tbody>

                                    ");
                                while($subcatRow = mysqli_fetch_array($subcatResult, MYSQLI_ASSOC)){
                                    $subcatInd = $subcatRow['id'];
                                    //var_dump($adRow);

                                    echo("
                                    <tr data-category=\"active\">
		                              <td data-title=\"Title\">
		                                 <h3>$subcatRow[subcategory]</h3>
		                              </td>
		                              <td data-title=\"Category\"><span class=\"adcategories\">$subcatRow[subcatkey]</span></td>
		                              <td data-title=\"Category\"><span class=\"adcategories\">$catRow[category]</span></td>
		                              <td data-title=\"Action\">
		                                 <div class=\"btns-actions\">
		                                   <a class=\"btn-action btn-edit\" href=\"./edit-subcategory.php?id=$subcatRow[id]&catid=$catRow[id]\"><i class=\"lni-pencil\"></i></a>
		                                    <a class=\"btn-action btn-delete\" href=\"./subcategory-delete.php?id=$subcatRow[id]&catid=$catRow[id]\"><i class=\"lni-trash\"></i></a>
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
