<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=1) header("Location: /seller-dashboard.php");
    }
    else header("Location: /login.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : "";


    if(isset($_GET['id'])){
        if($_SESSION['user_type']==1){
            $sql2 = "SELECT icon FROM category WHERE id = '$id' ";
            $result2 = mysqli_query($db,$sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($count2==1){

                $imageName = (isset($row2['icon'])) ? $row2['icon'] : "";
                if(isset($row2['icon'])&&$imageName!=""){
                    $uploadDirectory = "/assets/img/category/";
                    $file = SITE_ROOT . $uploadDirectory . $imageName;
                    if (file_exists($file)&&is_writable($file)) {
                        if(!unlink($file)) header("location: /show-category.php?note='can\'t delete'");
                    }
                    else header("location: /show-category.php?note='doesn\'t exist'");
                }

                //DELETE query
                $updateSql = "DELETE FROM category WHERE id=$id";

                if(mysqli_query($db, $updateSql)){
                    header("location: /show-category.php?note='deleted successfully'");
                }
                else {
                    echo("failed" . mysqli_error($db));
                    }

            }
        }
        else{
            header("location: /show-category.php?error='There is an issue with your user id.'");
        }
    }

?>
