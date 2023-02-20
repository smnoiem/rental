<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=1) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : "";


    if(isset($_GET['id'])){
        if($_SESSION['user_type']==1){
            $sql2 = "SELECT users_id, image FROM ads WHERE id = '$id' ";
            $result2 = mysqli_query($db,$sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($count2==1){

                $imageName = (isset($row2['image'])) ? $row2['image'] : "";
                if(isset($row2['image'])&&$imageName!=""){
                    $uploadDirectory = "/post_images/";
                    $file = SITE_ROOT . $uploadDirectory . $imageName;
                    if (file_exists($file)&&is_writable($file)) {
                        if(!unlink($file)) header("location: /admin-dashboard.php?note='can\'t delete'");
                    }
                    else header("location: /admin-dashboard.php?note='doesn\'t exist'");
                }

                //DELETE query
                $updateSql = "DELETE FROM ads WHERE id=$id";

                if(mysqli_query($db, $updateSql)){
                    header("location: /admin-dashboard.php");
                }
                else {
                    echo("failed" . mysqli_error($db));
                    }

            }
        }
        else{
            header("location: /admin-dashboard.php?error='There is an issue with your user id.'");
        }
    }

?>
