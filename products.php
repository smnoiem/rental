<?php
    include("conn.php");
    session_start();
    $canonicalUrl = "";
    $metaTitle = "";
    $metaDescription = "";
    $metaTags = "";
    if(isset($_GET['cat'])){

        $cat=$_GET['cat'];

        $locQ = "SELECT * FROM location WHERE lockey='$cat'";
        $locR = mysqli_query($db,$locQ);
        if(mysqli_num_rows($locR)>0) {
            while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
                $locF = $locRow['id'];
            }
            if(isset($locF)){
                $cookieName="location";
                $cookieVal=$locF;
                setcookie($cookieName, $cookieVal, time() + (86400 * 30*12), "/");
            }
            unset($cat);
        }
        else{
            //find category id
            $catIdQ = "SELECT id, category FROM category WHERE catkey='$cat'";
            $catIdR = mysqli_query($db, $catIdQ);
            if(mysqli_num_rows($catIdR)>0){
                while($catIdRow = mysqli_fetch_array($catIdR, MYSQLI_ASSOC)){
                    $catId = $catIdRow['id'];
                    $catName = $catIdRow['category'];
                }
            }
            else {
                unset($cat);
                if(isset($_COOKIE['location'])) $locF = $_COOKIE['location'];
                else header("Location: location.php");
            }
        }

        if(isset($_GET['subcat'])&&!isset($locF)&&isset($cat)){
            $subcat = $_GET['subcat'];

            $locQ = "SELECT * FROM location WHERE lockey='$subcat'";
            $locR = mysqli_query($db,$locQ);
            if(mysqli_num_rows($locR)>0) {
                while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
                    $locF = $locRow['id'];
                }
                if(isset($locF)){
                    $cookieName="location";
                    $cookieVal=$locF;
                    setcookie($cookieName, $cookieVal, time() + (86400 * 30*12), "/");
                }
                unset($subcat);
            }
            else{
                //find sub_category id
                $subcatIdQ = "SELECT id, subcategory FROM subcategory WHERE subcatkey='$subcat' and cat_id='$catId'";
                $subcatIdR = mysqli_query($db, $subcatIdQ);
                if(mysqli_num_rows($subcatIdR)>0){
                    while($subcatIdRow = mysqli_fetch_array($subcatIdR, MYSQLI_ASSOC)){
                        $subcatId = $subcatIdRow['id'];
                        $subcatName = $subcatIdRow['subcategory'];
                    }

                }
                else unset($subcat);
            }



            if(isset($_GET['loc'])&&!isset($locF)){
                $loc=$_GET['loc'];
                $locQ = "SELECT * FROM location WHERE lockey='$loc'";
                $locR = mysqli_query($db,$locQ);
                if(mysqli_num_rows($locR)>0) {
                    while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
                        $locF = $locRow['id'];
                    }

                    if(isset($locF)){
                        $cookieName="location";
                        $cookieVal=$locF;
                        setcookie($cookieName, $cookieVal, time() + (86400 * 30*12), "/");
                    }
                }
                else
                 {
                     if(isset($_COOKIE['location'])) $locF = $_COOKIE['location'];
                    else header("Location: location.php");
                }
            }
            else if(!isset($locF))
            {
                if(isset($_COOKIE['location'])) $locF = $_COOKIE['location'];
                else header("Location: location.php");
            }
        }
        else if(!isset($locF)&&isset($cat)) {
            //set locF for only category
            if(isset($_COOKIE['location'])) $locF = $_COOKIE['location'];
            else header("Location: location.php");
        }
    }
    else{
        if(isset($_COOKIE['location'])) $locF = $_COOKIE['location'];
        else header("Location: location.php");
    }

    //ads query
   if(isset($subcat)){
       $adsQ = "SELECT * FROM ads WHERE category='$catId' and sub_category='$subcatId' and location='$locF' and status='active'";
       $adsR = mysqli_query($db, $adsQ);
	    $locQ = "SELECT * FROM location WHERE id=$locF";
	    $locR = mysqli_query($db, $locQ);
	    $locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC);
	    $adLocation = $locRow['location'];
	    $locKey = $locRow['lockey'];
	    $pageTitle = $subcatName;
	    $pageRef = "cat=".$catId."&subcat=".$subcatId."&loc=".$locF;

	    //This block works when the site is visited with both Category and Subcategory
	    //So, you can use $subcatName, $catName and $adLocation in your meta title, description and tag(keywords)
	    $metaTitle = "You can put the " . $adLocation . "variable anywhere in the text ". $subcatName;
	    $metaDescription = $subcatName." for rent In ".$adLocation." for a reasonable price With Free Delivery To Your Location.";
	    $metaTags = $subcatName." for rent In ".$adLocation.", ".$subcatName." on rent In ".$adLocation.", rent ".$subcatName." In ".$adLocation;
        $canonicalUrl = "https://quickonrentals.com/products/$cat/$subcat/$locKey";
   }
   else if(isset($cat)){
       $adsQ = "SELECT * FROM ads WHERE category='$catId' and location='$locF' and status='active'";
       $adsR = mysqli_query($db, $adsQ);
	    $locQ = "SELECT * FROM location WHERE id=$locF";
	    $locR = mysqli_query($db, $locQ);
	    $locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC);
	    $adLocation = $locRow['location'];
	    $locKey = $locRow['lockey'];
	    $pageTitle = $catName;
	    $pageRef = "cat=".$catId."&loc=".$locF;

	    //This block works when the site is visited with just Category and no Subcategory
	    //So, you can use only $catName and $adLocation in your meta title, description and tag(keywords)
	    $metaTitle = $catName." For Rent in ".$adLocation;
	    $metaDescription = $catName." for rent In ".$adLocation." for a reasonable price With Free Delivery To Your Location.";
	    $metaTags = $catName." for rent In ".$adLocation.", ".$catName." on rent In ".$adLocation.", rent ".$catName." In ".$adLocation;
        $canonicalUrl = "https://quickonrentals.com/products/$cat/$locKey";

   }
   else{
       $adsQ = "SELECT * FROM ads WHERE location='$locF' and status='active'";
       $adsR = mysqli_query($db, $adsQ);
        $locQ = "SELECT * FROM location WHERE id=$locF";
        $locR = mysqli_query($db, $locQ);
        $locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC);
        $adLocation = $locRow['location'];
	    $locKey = $locRow['lockey'];
        $pageTitle = $adLocation;
	    $pageRef = "loc=".$locF;

	    //This block works when the site is visited with no Category and no Subcategory
	    //So, you can use only $adLocation in your meta title, description and tag(keywords)
	    $metaTitle = "Renting Made Easy | Quickonentals";
	    $metaDescription = "Projector on rent in ".$adLocation." with HDMI cable support tripod screen....";
	    $metaTags = "Projector for rent In ".$adLocation.", Projector on rent In ".$adLocation.", rent Projector In ".$adLocation;
        $canonicalUrl = "https://quickonrentals.com/products/$locKey";

   }
    //ads  query ends
    include("header.php");
?>

<!--Begin Modal-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="onload" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>Get the best deals</h4>
			<button type="button" class="close" data-dismiss="modal">&#10799;</button>
			</div>
			<div class="modal-body">
				<div class="md-form mb-5">
	          			<i class="fa fa-user prefix grey-text"></i>
	          				<input type="text" id="name" class="form-control validate" placeholder="Name" required>

	        		</div>
	        		<div class="md-form mb-5">
	         			<i class="fa fa-envelope prefix grey-text"></i>
	          				<input type="email" id="email" class="form-control validate" placeholder="Enter Your E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>

	        		</div>

	       			 <div class="md-form mb-4">
	          			<i class="fa fa-phone prefix grey-text"></i>
	          				<input type="tel" id="tel" class="form-control validate phn" placeholder="Enter Your 10 Digit Mobile Number" pattern="/(7|8|9)\d{9}/" required>

	       			 </div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" onclick="userDataCapture()">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--End Modal-->
<script>
	function getCookie(name) {
	  var value = "; " + document.cookie;
	  var parts = value.split("; " + name + "=");
	  if (parts.length == 2) return parts.pop().split(";").shift();
	}
	function setCookie(name, email,phone) {
		var now = new Date();
		var time = now.getTime();
		time += 24 * 3600 * 1000;
		now.setTime(time);
		document.cookie =
		'name_jdc=' + name +
		'; expires=' + now.toUTCString() +
		'; path=/';
		document.cookie =
		'email_jdc=' + email +
		'; expires=' + now.toUTCString() +
		'; path=/';
		document.cookie =
		'phone_jdc=' + phone +
		'; expires=' + now.toUTCString() +
		'; path=/';
		window.location.reload();
	}
	function userDataCapture() {
		name = $("#name").val();
		if(name == "") {
			$("#name").focus();
			return;
		}
		email = $("#email").val();
		if(email == "") {
			$("#email").focus();
			return;
		}
		phone = $("#tel").val();
		if(phone == "") {
			$("#tel").focus();
			return;
		}
		cat = <?php if(isset($catId)) echo($catId); ?>;
		subcat = <?php if(isset($catId)) echo($catId); ?>;
		loc = getCookie("location");
		param = { name: name, email: email, phone: phone, cat: cat, subcat: subcat, loc: loc }
		$.post( "/add-userdata.php", param)
		  .done(function( mdata ) {
		      console.log(mdata);
		    if(mdata==="OK") {
		        setCookie(name,email,phone);
		    }
		  });
		$('#onload').modal('hide');
		return;
	}
</script>
<script>
    var mstring = "";
     mstring = mstring+"<?= $adLocation; ?>| ";
     mstring = mstring+"<?php if(isset($cat)) echo($catName); else echo($adLocation); ?> | ";
     mstring = mstring+"<?php if(isset($subcat)) echo($subcatName); else if(isset($cat))  echo($cat); else echo($adLocation); ?> ";
     document.title = mstring;
</script>

<div class="page-header" style="background: url(/assets/img/banner1.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-wrapper">
				    					<h2 class="product-title"><?= $pageTitle; ?>&nbsp;Rental&nbsp;Listings</h2>
					<ol class="breadcrumb">
					    <?php
                            if(isset($subcat)){
                                echo
                                "<li> <a href='/category.php?cat=".$catId."'>". $catName ." ></a> </li>".
                                "<li class=\"current\">".$subcatName."</li>
                                ";
                            }
                            else if(isset($cat)){
                                echo
                                "<li> <a href='/category.php?cat=".$catId."'>". $catName ." ></a> </li>".
                                "<li class=\"current\">".$catName."</li>
                                ";
                            }
                            else {
                                echo
                                "<li> <a href='/category.php?loc=".$locF."'>". $adLocation ." ></a> </li>".
                                "<li class=\"current\">".$adLocation."</li>
                                ";
                            }

						?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-container section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
				<aside>

						<div class="widget categories">
							<h4 class="widget-title">Category Filter</h4>
							<div class="form-group">
								<div class="select">
									<select class="form-control" id='cat-filter' onchange="changedCategory()">
                                        <option value="0">All Category</option>
                                        <?php
                                            $catQ = "SELECT * FROM category";
                                            $catR = mysqli_query($db,$catQ);
                                            while($catRow = mysqli_fetch_array($catR, MYSQLI_ASSOC)){
                                                $selected = "";
                                                if(isset($catId)&&$catRow['id']==$catId) $selected = "selected";
                                                echo("
                                                 <option value=\"$catRow[id]\" $selected>$catRow[category]</option>
                                                \n");
                                            }
                                        ?>

									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="select">
									<select class="form-control" id='subcat-filter' onchange="changedSubcategory()">
                                        <option value="0">All Subcategory</option>
                                        <?php
                                            if(isset($catId)) $subCatQ = "SELECT * FROM subcategory WHERE cat_id=$catId";
                                            else  $subCatQ = "SELECT * FROM subcategory";
                                            $subCatR = mysqli_query($db,$subCatQ);
                                            while($subCatRow = mysqli_fetch_array($subCatR, MYSQLI_ASSOC)){
                                                $selected = "";
                                                if(isset($subcatId)&&$subCatRow['id']==$subcatId) $selected = "selected";
                                                echo("
                                                 <option value=\"$subCatRow[id]\" $selected>$subCatRow[subcategory]</option>
                                                \n");
                                            }
                                        ?>


                                    </select>
								</div>
							</div>
							<script>
								function changedCategory() {
									$('#cat-filter').attr('disabled', 'disabled');
									$('#subcat-filter').attr('disabled', 'disabled');
									cat = $('#cat-filter').val();
									if(cat != 0) location.href = "/category.php?cat="+cat;
								}
								function changedSubcategory() {
									$('#cat-filter').attr('disabled', 'disabled');
									$('#subcat-filter').attr('disabled', 'disabled');
									cat = $('#cat-filter').val();
									subcat = $('#subcat-filter').val();
									if(cat != 0) location.href = "/category.php?cat="+cat+"&subcat="+subcat;
								}
							</script>

							<div class="alert alert-warning">
								Your selected location is <strong><?= $adLocation; ?></strong>
								 Click <a href='/locations.php?<?= $pageRef; ?>'>here</a> to change location.
							</div>
							<?php
							if(isset($_COOKIE['name'])&&isset($_COOKIE['email'])&&isset($_COOKIE['phone']) ){
							    echo("
                                <div class=\"alert alert-warning\">
									Name: <strong>$_COOKIE[name]</strong><br />
									Email: <strong>$_COOKIE[email]</strong><br />
									Phone: <strong>$_COOKIE[phone]</strong><br />
									Click <a href=\"#\" onclick=\"deleteCookie()\">here</a> to change information.
								</div>

								<script>
									function delete_cookie(name) {
										document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
									}
									function deleteCookie() {
										delete_cookie('name');
										delete_cookie('email');
										delete_cookie('phone');
										window.location.reload();
									}
								</script>
								");
                            }
                            ?>



													</div>
						<h1 style="font-size:1px; color:#fff;"></h1>

						<h2 style="font-size:1px; color:#fff;"></h2>
					</aside>
				</div>
				<div class="col-lg-9 col-md-12 col-xs-12 page-content">
<div class="adds-wrapper">
<div class="tab-content">
<div id="grid-view" class="tab-pane fade">
	<div class="row">




	</div>
</div>


<div id="list-view" class="tab-pane fade active show">
	<div class="row">

	    <?php
        while($adsRow = mysqli_fetch_array($adsR, MYSQLI_ASSOC)){
            $sellerId = $adsRow['sellers_id'];
            if(!isset($sellerRow['$sellerId'])){

                $sellerQ = "SELECT * FROM sellers WHERE id=$sellerId";
                $sellerR = mysqli_query($db, $sellerQ);
                $sellerRow[$sellerId] = mysqli_fetch_array($sellerR, MYSQLI_ASSOC);
            }
            if($adsRow['verified']=="yes")
                $verified = "
                    <div class=\"btn-verified float-right\">
							<i class=\"lni-check-box\"></i> Verified Ad
						</div>
                ";
            else $verified = "";
           echo
           "
			<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
			<div class=\"featured-box\">
				<figure>
					<a href=\"/seller-profile.php?id=".$sellerRow[$sellerId]['id']."\">
						<img class=\"img-fluid\" src=\"/post_images/$adsRow[image]\" style=\"height:300px; width=300px;\"
						        alt=\"$adsRow[details]\">
					</a>
				</figure>
				<div class=\"feature-content\">
					<div class=\"product\">
						<a href=\"/seller-profile.php?id=$sellerId\">
							<i class=\"lni-folder\"></i> $adsRow[title]
                        </a>
					</div>
					<h4>
						<a href=\"/seller-profile.php?id=$sellerId\">"
							. $sellerRow[$sellerId]['bname'] .
						"</a>

					</h4>
					<span>". $sellerRow[$sellerId]['address'] . "</span>
					<ul class=\"address\">
						<li>
							<a href=\"/seller-profile.php?id=$sellerId\">
								<i class=\"lni-map-marker\"></i> ". $adLocation ."
                            </a>
						</li>
						<li>
							<a href=\"/seller-profile.php?id=$sellerId\">
								<i class=\"lni-hourglass\"></i> ". $sellerRow[$sellerId]['estab'] . "
                            </a>
						</li>
						<li>
							<a href=\"/seller-profile.php?id=$sellerId\">
								<i class=\"lni-phone-handset\"></i> ". $sellerRow[$sellerId]['phone'] . "
                            </a>
						</li>
						<li>
							<a href=\"/seller-profile.php?id=$sellerId\">
								<i class=\"lni-phone-handset\"></i> ". $sellerRow[$sellerId]['aphone'] . "
                            </a>
						</li>
						<li style=\"width:100% !important;\">
							<a href=\"/seller-profile.php?id=$sellerId\">
                                <i class=\"lni-envelope\"></i> ". $sellerRow[$sellerId]['email'] . "
                            </a>
						</li>
					</ul>
					<div class=\"listing-bottom\">"
                        .$verified.
                    "</div>
				</div>
			</div>
		</div>
		";
		}
		?>

	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
   $(window).load(function(){
                $('#onload').modal('<?php
                 if(isset($subcat)&&!isset($_COOKIE['name'])) echo("show");
                 else echo("hide");
                 ?>');
   });
</script>

<?php
    include("footer.php");
?>
