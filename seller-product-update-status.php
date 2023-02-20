<?php
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=2) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : "";
    $type = (isset($_GET['type'])) ? $_GET['type'] : "";


    if(isset($_GET['id'])&&isset($_GET['type'])){
        $sql = "SELECT * FROM sellers WHERE users_id = '$_SESSION[id]' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count==1){
            $sql2 = "SELECT users_id FROM ads WHERE id = '$id' ";
            $result2 = mysqli_query($db,$sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($count2==1 && $row2['users_id']==$_SESSION['id']){
                    if($type=="INACT") $status = "inactive";
                    else if($type=="ACT") $status = "active";
                    //UPDATE query
                    $updateSql = "UPDATE ads SET status='$status' WHERE id=$id";

                    if(mysqli_query($db, $updateSql)){
                        header("location: /seller-dashboard.php");
                    }
                    else {
                        echo("failed" . mysqli_error($db));
                        //header("location: /seller-register.php");
                        }
            }
            else echo("This product is not associated with your account.");
        }
        else{
            header("location: /seller-dashboard.php?error='There is an issue with your user id.'");
        }
    }

    //echo("$bemail $bname $users_id $website\n");

?>
