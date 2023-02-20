<?php
    include("conn.php");
    session_start();
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
<h2 class="product-title">About Us</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">About Us</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="login section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<p class="intro-desc">
				    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    Content Goes Here...
                    <br>
                    <br>
                    <br>
                    <br>
                </p>
			</div>



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
