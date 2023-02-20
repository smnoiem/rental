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
        $catId = $_GET['catid'];
        if($_SESSION['user_type']==1){
            $sql2 = "SELECT * FROM subcategory WHERE id = '$id' ";
            $result2 = mysqli_query($db,$sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($count2==1){

                //DELETE query
                $updateSql = "DELETE FROM subcategory WHERE id=$id";

                if(mysqli_query($db, $updateSql)){
                    header("location: /show-subcategory.php?id=$catId&note='deleted successfully'");
                }
                else {
                    echo("failed" . mysqli_error($db));
                    }

            }
        }
        else{
            header("location: /show-subcategory.php?id=$catId&error='There is an issue with your user id.'");
        }
    }

?>
