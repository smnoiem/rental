<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_POST['name'])&&isset($_POST['catid'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==1){
        $catId = $_POST['catid'];
        $subcat = $_POST['name'];
        $subcatkey = $_POST['name'];
        $subcatkey = strtolower(str_replace(' ', '', $subcatkey));
        $subcatQ = "SELECT * FROM subcategory WHERE subcategory='$subcat' or catkey='$subcatkey'";
        $subcatR = mysqli_query($db, $subcatQ);
        $num = mysqli_num_rows($subcatR);
        if($num>0) header("Location: show-subcategory.php?id=$catId&msg=Duplicate Found! Try Another.");
        else{
            if(isset($_POST['submit'])){

                $insQ = "INSERT INTO subcategory(subcategory, subcatkey, cat_id)
                VALUES ('$subcat', '$subcatkey', '$catId')";

                if(mysqli_query($db, $insQ)) header("Location: show-subcategory.php?id=$catId&msg=SubCategory Added Successfully");
                else  header("Location: show-subcategory.php?id=$catId&msg=SubCategory Adding Failed");

            }
            else header("Location: seller-dashboard.php");
        }
    }
    else header("Location: seller-dashboard.php");

?>
