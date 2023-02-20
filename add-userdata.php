<?php
    include("conn.php");
    if(isset($_POST['name'])) $name = $_POST['name'];
    if(isset($_POST['email'])) $email = $_POST['email'];
    if(isset($_POST['phone'])) $phone = $_POST['phone'];
    if(isset($_POST['cat'])) $cat = $_POST['cat'];
    if(isset($_POST['subcat'])) $subcat = $_POST['subcat'];
    if(isset($_POST['loc'])) $loc = $_POST['loc'];

    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['phone'])) {
        $usQ = "INSERT INTO userdata(name, email, phone, cat, subcat, location)
        VALUES ('$name', '$email', '$phone', '$cat', '$subcat', '$loc') ";
        if((setcookie("name", $name , time() + (86400 * 30 * 6), "/"))
            &&(setcookie("email", $email , time() + (86400 * 30 * 6), "/"))
            &&(setcookie("phone", $phone , time() + (86400 * 30 * 6), "/"))
            &&mysqli_query($db, $usQ)

        ) echo("OK");
    }
    //else var_dump($_COOKIE);
?>
