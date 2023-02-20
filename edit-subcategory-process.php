<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['subcatkey'])&&isset($_SESSION['iuser_typed'])&&$_SESSION['user_type']==1){
        $subcatId = $_POST['id'];
        $subcat = $_POST['name'];
        $subcatkey = $_POST['subcatkey'];
        $subcatkey = strtolower(str_replace(' ', '', $subcatkey));
        $subcatQ = "SELECT * FROM subcategory WHERE id = $subcatId";
        $subcatR = mysqli_query($db, $subcatQ);
        $subcatRow = mysqli_fetch_array($subcatR, MYSQLI_ASSOC);
        $catId = $subcatRow['cat_id'];
        $num = mysqli_num_rows($subcatR);

        if(isset($_POST['submit'])&&$num==1){

            $updateQ = "UPDATE subcategory SET subcategory='$subcat', subcatkey='$subcatkey' WHERE id=$subcatId";
            if(mysqli_query($db, $updateQ)) header("Location: show-subcategory.php?id=$catId&msg=Sub Category Updated Successfully");
            else  header("Location: show-subcategory.php?$catId&msg=Sub Category Update Failed");
        }
        else header("Location: seller-dashboard.php");
    }
    else header("Location: seller-dashboard.php");

?>
