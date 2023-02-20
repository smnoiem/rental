<?php
    $cat = "";
    $subcat = "";
    if(isset($_GET['cat'])) $cat = $_GET['cat'];
    if(isset($_GET['subcat'])) $subcat = $_GET['subcat'];
    //echo("$cat $subcat");
    include("conn.php");
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
<h2 class="product-title">Top Cities</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Cities</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="login section-padding">
	<div class="container">
		<div class="row justify-content-center">

            <?php
                $locQ = "SELECT * FROM location";
                $locR = mysqli_query($db,$locQ);
                while($row = mysqli_fetch_array($locR, MYSQLI_ASSOC)){

                    echo("

                        <div class=\"col-lg-4 col-md-12 col-xs-12\">
                            <div class=\"rounded box\">
                                 <a href=\"./category.php?cat=".$cat."&subcat=".$subcat."&loc=".$row['id']."\">
                                    <h3 class=\"city_style\">$row[location]</h3>
                                 </a>
                            </div>
                        </div>

                    \n");


                }

            ?>



		</div>
	</div>
</section>

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
