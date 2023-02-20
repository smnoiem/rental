<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "Set Canocical URL here";
    $metaTitle = "Write the MetaTitle Here.";
    $metaDescription = "Write Meta Description";
    $metaTags = "Write meta tags here";
    if(isset($_GET['id'])&&$_GET['id']!=""){
        $sellerId = $_GET['id'];
        $adsQ = "SELECT * FROM ads WHERE sellers_id='$sellerId' and status='active'";
        $adsR = mysqli_query($db, $adsQ);
        if(mysqli_num_rows($adsR)<=0) header("location: /index.php");
    }
    else header("location: /index.php");
    $sellerQ = "SELECT * FROM sellers WHERE id=$sellerId";
    $sellerR = mysqli_query($db, $sellerQ);
    //var_dump($sellerR);
    if(mysqli_num_rows($sellerR)<=0) header("location: /index.php");
    else $sellerRow = mysqli_fetch_array($sellerR, MYSQLI_ASSOC);
    $sellerLocation = $sellerRow['location'];

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
    $locQ = "SELECT * FROM location";
    $locR = mysqli_query($db, $locQ);
    while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
        $ind = $locRow['id'];
        $locArr[$ind] = $locRow['location'];
    }

    include("header.php");
?>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title"><?= $sellerRow['bname']; ?></h2>
<ol class="breadcrumb">
<li><a href="./">Home /</a></li>
<li class="current"><?= $sellerRow['bname']; ?></li>
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
<a href="#"><img src="/user_images/<?= $sellerRow['image']; ?>" alt="" width="72px" height="72px"></a>
</figure>
<div class="usercontent">
<h3><?= $sellerRow['bname']; ?></h3>
<h4><?= $locArr[$sellerLocation] ?></h4>
</div>
<div class="usercontentbox">
<p><i class="lni-map-marker"></i><?= $sellerRow['address']; ?></p>
<p><i class="lni-envelope"></i> <?= $sellerRow['email']; ?></p>
<p><i class="lni-headphone-alt"></i> <?= $sellerRow['phone']; ?></p>
<?php
    if(isset($sellerRow['aphone'])) echo("<p><i class=\"lni-headphone-alt\"></i>$sellerRow[aphone]</p>");
?>
</div>
</div>

<nav class="navdashboard">

</nav>
</div>

</aside>
</div>
<div class="col-sm-12 col-md-8 col-lg-9">
            <div class="page-content">
               <div class="inner-box">

                  <div class="dashboard-wrapper">

                     <table class="table table-responsive dashboardtable tablemyads">
                        <thead>
                           <tr>

                              <th>Photo</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Sub Category</th>

                           </tr>
                        </thead>
                        <tbody>

                            <?php
                                while($adsRow = mysqli_fetch_array($adsR, MYSQLI_ASSOC)){

                                    $catInd = $adsRow['category'];
                                    $subCatInd = $adsRow['sub_category'];
                                    $adLocation = $adsRow['location'];

                                    echo("
                                        <tr data-category=\"inactive\">
                                              <td class=\"photo\">
                                                <img class=\"img-fluid\"
                                                    src=\"/post_images/$adsRow[image]\" alt=\"\">
                                              </td>
                                              <td data-title=\"Title\">
                                                 <h3>$adsRow[title]</h3>
                                                 <span>$locArr[$adLocation]</span>
                                              </td>
                                              <td data-title=\"Category\">
                                                <span class=\"adcategories\">$catArr[$catInd]</span>
                                              </td>
                                              <td data-title=\"SubCategory\">
                                                <span class=\"adcategories\">$subCatArr[$subCatInd]</span>
                                              </td>
                                        </tr>

                                    ");
                                }
                             ?>

                            </tbody>
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
