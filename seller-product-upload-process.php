<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=2) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $name = $_POST['name'];
    $cat = $_POST['cat'];
    $subcat = $_POST['subcat'];
    $location = $_POST['location'];
    $description = (isset($_POST['description'])) ? $_POST['description'] : "";
    $users_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

    //var_dump($_FILES[img_file]);
    //$img_name = $_FILES["img_file"];
    //if(isset($_POST['submit'])){
        //echo("$name $cat $subcat $location $description $img_name[name]");
    //}
    //else echo("got nothing");



    if(isset($_FILES['img_file'])&&isset($_POST['submit'])){
        //upload image


        $currentDir = getcwd();
        $uploadDirectory = "/post_images/";

        $errors = []; // Store all foreseen and unforseen errors here

        $fileName = $_FILES['img_file']['name'];
        //$fileSize = $_FILES['img_file']['size'];
        $fileTmpName  = $_FILES['img_file']['tmp_name'];
        $fileType = $_FILES['img_file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $myrand = rand();
        $fpname = $name;
        //preg_replace("/(#\w+)/", "_", $fpname);
        $fpname = preg_replace('/\s+/', '_', $fpname);


        $uploadPath = SITE_ROOT . $uploadDirectory . $fpname . $myrand. "." . $fileExtension;
        $uploadedName = $fpname . $myrand . "." . $fileExtension;
        //$uploadPath = $currentDir . $uploadDirectory . $users_id. "." . $fileExtension;
        //basename($fileName);


        /*
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 500000) {
            $errors[] = "This file is more than 500KB. Sorry, it has to be less than or equal to 500KB";
        }
        */

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                //image upload done
                //db queries start


                $sql = "SELECT * FROM sellers WHERE users_id = '$users_id' ";
                $result = mysqli_query($db,$sql);
                //var_dump($result);
                $count = mysqli_num_rows($result);
                if($count==1){
                    $sellerRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $insertSql = "INSERT INTO ads (title, category, sub_category, location, details, image, sellers_id, users_id)
                    VALUES ('$name', '$cat', '$subcat', '$location', '$description', '$uploadedName', '$sellerRow[id]', '$users_id')";

                    if(mysqli_query($db, $insertSql) ){
                        header("location: /seller-dashboard.php?note='$sellerRow[id]'");
                    }
                    else {
                        echo("failed" . mysqli_error($db));
                        }
                }
                else{
                    header("location: /seller-dashboard.php");
                }

                //db queries done
            } else {
                echo "An error occurred with file upload. Try again or contact the admin";
            }
        } else {
            echo("These errors occurred:<br>");
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }


        //upload done
    }
    else if(isset($_POST['submit'])){
        $sql = "SELECT * FROM sellers WHERE users_id = '$users_id' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count<=0){

            $sellerRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $insertSql = "INSERT INTO sellers (bname, email, phone, aphone, estab, location, address, website, gstin, plan, sellers_id, users_id)
            VALUES ('$bname', '$bemail', '$phone', '$altphone', '$est', '$location', '$address', '$website', '$gstin', '$plan', '$sellerRow[id]', '$users_id')";

            $query2 = "UPDATE users SET user_type=2 WHERE id='$users_id' ";

            if(mysqli_query($db, $insertSql) && mysqli_query($db, $query2)){
                $_SESSION['user_type'] = 2;
                header("location: /seller-dashboard.php");
            }
            else {
                echo("failed" . mysqli_error($db));
                //header("location: /seller-register.php");
                }
        }
        else{
            header("location: /seller-dashboard.php");
        }
    }
    //echo("$bemail $bname $users_id $website\n");

?>
