<?php
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=1) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : "";
    $type = (isset($_GET['type'])) ? $_GET['type'] : "";


    if(isset($_GET['id'])&&isset($_GET['type'])){
        if($_SESSION['user_type']==1){
            $sql2 = "SELECT users_id FROM ads WHERE id = '$id' ";
            $result2 = mysqli_query($db,$sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($count2==1){
                    if($type=="cancel") $status = "not";
                    else if($type=="verify") $status = "yes";
                    //UPDATE query
                    $updateSql = "UPDATE ads SET verified='$status' WHERE id=$id";

                    if(mysqli_query($db, $updateSql)){
                        header("location: /admin-dashboard.php");
                    }
                    else {
                        echo("failed" . mysqli_error($db));
                        //header("location: /seller-register.php");
                        }
            }
            else echo("Something went wrong..");
        }
        else{
            header("location: /seller-dashboard.php?error='You're not an admin. Please sign in again'");
        }
    }

    //echo("$bemail $bname $users_id $website\n");

?>
