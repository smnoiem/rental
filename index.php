<?php
    include("conn.php");
    
    session_start();
    
    $canonicalUrl = "https://quickonrentals.com/";
    $metaTitle = "Projector and screen Rent in Bangalore | Speaker for Rent - Quickonrentals.com";
    $metaDescription = "Projector and Screen Rent in Bangalore with Reasonable Price. Free Delivery Available. Speakers for Rent in Bangalore. Call us:6362328251.";
    $metaTags = "projector for rent,rent projector in bangalore, hire projector and screen in bangalore, projector for rent in indiranagar, projector for rent in whitefield,Projectors on hire near me in Bangalore,quickonrentals, quickon rentals, projector rent in Bengaluru,Karnataka";
    
    if(isset($_COOKIE['location'])) $location = $_COOKIE['location'];
    else $location = 1;

    $locQ = "SELECT location FROM location WHERE id=$location";
    $locRR = mysqli_query($db,$locQ);
    if(mysqli_num_rows($locRR)==1) while($locRow = mysqli_fetch_array($locRR, MYSQLI_ASSOC)){
        $locName = $locRow['location'];
    }
    include("header.php");
?>

<div id="hero-area">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-xs-12 text-center">
				<div class="contents">
					<h2 class="head-title">RENTALS MADE EASY WITH 
						<span class="year">QUICKON</span>
					</h2>
						<div class="search-bar">
							<div class="search-inner">
								<form class="search-form" method="GET" action="category.php" onsubmit="return validateSearchForm()">
									<div class="form-group inputwithicon">
										<i class="lni-tag"></i>
										<div class="select">
											<select onchange='setSubCat(this.value);' name="cat" id="search_cat">
												<option value="0">All Categories</option>
                                                    <?php
                                                        $catQ = "SELECT * FROM category";
                                                        
                                                        $catR = mysqli_query($db,$catQ);
                                                        
                                                        while($catRow = mysqli_fetch_array($catR, MYSQLI_ASSOC)){
                                                            echo("
                                                             <option value=\"$catRow[id]\" >$catRow[category]</option>
                                                            \n");
                                                        }
                                                    ?>

                                            </select>

                                        </div>
									</div>
									<div class="form-group inputwithicon">
										<i class="lni-tag"></i>
										<div class="select">
											<select id='search_subcat' name="subcat" disabled>
												<option value="0">All Sub-Categories</option>
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

                                            <?php

                                                echo("
                                                    <script>
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
                                                            var opt_str = \"<option value=\\\"0\\\">All Sub-Categories</option>\";
                                                            for(var i in subcat_array) {
                                                                 var id = parseInt(subcat_array[i][0]);
                                                                 var category = parseInt(subcat_array[i][1]);
                                                                 var name = subcat_array[i][2];
                                                                 if(cat == category || cat==0) {
                                                                    opt_str = opt_str+\"<option value='\"+id+\"'>\"+name+\"</option>\";
                                                                 }
                                                            }
                                                            $('#search_subcat').html(opt_str);
                                                            $('#search_subcat').prop('disabled', false);
                                                            $('#search_subcat').focus();
                                                        }

                                                    </script>
                                                ");
											?>

										</div>
									</div>
									<div class="form-group inputwithicon">
										<i class="lni-map-marker"></i>
										<div class="select">
											<select name="loc" id='search_loc'>
												<option value="0">Locations</option>

												<?php
                                                    $locQ = "SELECT * FROM location";
                                                    $result2 = mysqli_query($db,$locQ);
                                                    while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                                        $selected = "";
                                                        if($location==$row2['id']) $selected = "selected";
                                                        echo("<option value=$row2[id] $selected>$row2[location]</option>\n");
                                                    }

                                                ?>
                                            </select>
										</div>
									</div>
<button class="btn btn-common" type="submit"><i class="lni-search"></i> Search Now</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<script>
	function validateSearchForm() {
		cat = $("#search_cat").val();
		subcat = $("#search_subcat").val();
		loc = $("#search_loc").val();
		if(cat==0||subcat==0||loc==0) {
			alert("Please select valid options.");
			return false;
		}
	}
</script>



<section id="categories" class="section-padding bg-drack">
	<div class="container">
	    <h2 style="font-size:1px; color:#fff;">projector on rent in mumbai</h2>
		<h2 class="section-title">Categories</h2>
		<div class="row">



            <?php
                $catQ = "SELECT * FROM category ORDER BY category";
                $catR = mysqli_query($db, $catQ);
                while($catRow=mysqli_fetch_array($catR, MYSQLI_ASSOC)){
                    echo("

                        <div class=\"col-lg-3 col-md-6 col-xs-12\">
                            <div class=\"category-box\">
                                <div class=\"icon\">
                                    <img src=\"assets/img/category/$catRow[icon]\"
                                        class=\"i-style\" height=\"60px\" width=\"60px\"
                                        alt=\"$catRow[category] for rent In $locName\" />
                                </div>

                                <div class=\"category-header\">
                                    <a href=\"category.php?cat=$catRow[id]\">
                                            <div class=\"custom_title\">
                                                <p>$catRow[category]<br />For Rent</p>
                                            </div>
                                    </a>
                                </div>

                                <div class=\"category-content\">
                                    <ul>

                    ");
                    //subcat query
                    $subcatQ = "SELECT * FROM subcategory WHERE cat_id=$catRow[id] ORDER BY subcategory LIMIT 5";
                    $subcatR = mysqli_query($db, $subcatQ);
                    while($subcatRow=mysqli_fetch_array($subcatR, MYSQLI_ASSOC)){
                        $adsQ = "SELECT sub_category FROM ads WHERE sub_category=$subcatRow[id] and location = $location";
                        $adsR = mysqli_query($db, $adsQ);
                        $adsnum = mysqli_num_rows($adsR);

                        echo("
                            <li>
								<a href=\"category.php?cat=$catRow[id]&subcat=$subcatRow[id]\">
									<span>$subcatRow[subcategory] </span>
									<sapn>$adsnum</sapn>
								</a>
							</li>


                        ");
                    }



                    echo("
                                        <li>
                                            <a href=\"category.php?cat=$catRow[id]\">
                                                <span>View All
                                                    <i class=\"lni-arrow-right\"></i>
                                                </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>


                            </div>
                        </div>

                    ");
                }

            ?>





        </div>
	</div>
</section>


<section class="cities section-padding bg-white">
	<div class="container">
		<h2 class="section-title">Top Cities</h2>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-xs-12">
				<a href="category.php?loc=7" class="img-box">
					<div class="img-box-content">
						<h4>Kolkata</h4>

					</div>
					<div class="img-box-background">
						<img class="img-fluid" src="assets/img/cities/Kolkata.jpg" alt="Rent, Hire & Lease Anything Online In Kolkata">
						</div>
					</a>
				</div>
				<div class="col-lg-6 col-md-6 col-xs-12">
					<a href="category.php?loc=2" class="img-box">
						<div class="img-box-content">
							<h4>Bengaluru</h4>

						</div>
						<div class="img-box-background">
							<img class="img-fluid" src="assets/img/cities/bangalore.webp" alt="Rent, Hire & Lease Anything Online In Bangalore">
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-xs-12">
						<a href="category.php?loc=4" class="img-box">
							<div class="img-box-content">
								<h4>Mumbai</h4>

							</div>
							<div class="img-box-background">
								<img class="img-fluid" src="assets/img/cities/mumbai.webp" alt="Rent, Hire & Lease Anything Online In Mumbai">
								</div>
							</a>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12">
							<a href="category.php?loc=5" class="img-box">
								<div class="img-box-content">
									<h4>Delhi</h4>

								</div>
								<div class="img-box-background">
									<img class="img-fluid" src="assets/img/cities/delhi.webp" alt="Rent, Hire & Lease Anything Online In Delhi">
									</div>
								</a>
							</div>
							</div>
						</div>
					</section>






<script>
	var cities = [{"id":"1","name":"Guwahati","latitude":"26.144518","longitude":"91.736237"},{"id":"2","name":"Bangalore","latitude":"12.971599","longitude":"77.594566"},{"id":"3","name":"Chennai","latitude":"13.08268","longitude":"80.270721"},{"id":"4","name":"Mumbai","latitude":"19.075983","longitude":"72.877655"},{"id":"5","name":"Delhi","latitude":"28.70406","longitude":"77.102493"},{"id":"6","name":"Hyderabad","latitude":"17.385044","longitude":"78.486671"},{"id":"7","name":"Kolkata","latitude":"22.572645","longitude":"88.363892"},{"id":"8","name":"Pune","latitude":"18.52043","longitude":"73.856743"},{"id":"10","name":"Mysore","latitude":"12.29581","longitude":"76.639381"},{"id":"11","name":"Vishakapatnam","latitude":"17.686815","longitude":"83.218483"},{"id":"12","name":"Surat","latitude":"21.17024","longitude":"72.831062"},{"id":"13","name":"Ahmedabad","latitude":"23.022505","longitude":"72.571365"},{"id":"14","name":"Patna","latitude":"25.594095","longitude":"85.137566"},{"id":"15","name":"Kanpur","latitude":"26.449923","longitude":"80.331871"},{"id":"16","name":"Vijayawada","latitude":"16.506174","longitude":"80.648018"},{"id":"17","name":"Jamshedpur","latitude":"22.804565","longitude":"86.202873"}];
	function getDistance(lat1, lon1, lat2, lon2, unit) {
		if ((lat1 == lat2) && (lon1 == lon2)) {
			return 0;
		}
		else {
			var radlat1 = Math.PI * lat1/180;
			var radlat2 = Math.PI * lat2/180;
			var theta = lon1-lon2;
			var radtheta = Math.PI * theta/180;
			var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
			if (dist > 1) {
				dist = 1;
			}
			dist = Math.acos(dist);
			dist = dist * 180/Math.PI;
			dist = dist * 60 * 1.1515;
			if (unit=="K") { dist = dist * 1.609344 }
			if (unit=="N") { dist = dist * 0.8684 }
			return dist;
		}
	}
	function getCookie(name) {
	  var value = "; " + document.cookie;
	  var parts = value.split("; " + name + "=");
	  if (parts.length == 2) return parts.pop().split(";").shift();
	  else return null;
	}
	function setCookie(id) {
		var now = new Date();
		var time = now.getTime();
		time += 24 * 3600 * 1000;
		now.setTime(time);
		document.cookie =
		'auto_location_jdc=' + id +
		'; expires=' + now.toUTCString() +
		'; path=/';
		document.cookie =
		'location=' + id +
		'; expires=' + now.toUTCString() +
		'; path=/';
		window.location.reload();
	}
	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else {
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}
	function showPosition(position) {
	    var latitude = position.coords.latitude;
	    var longitude = position.coords.longitude;
            cities.sort(function(a, b){
	        return getDistance(latitude,longitude,a.latitude,a.longitude,'K')-getDistance(latitude,longitude,b.latitude,b.longitude,'K');
	    });
	    if(!getCookie('auto_location_jdc')) {
		    if(confirm(JSON.stringify("Set location to: "+cities[0].name+"?"))) {
		    	setCookie(cities[0].id);
		    }
	    }
	}
	getLocation();
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
