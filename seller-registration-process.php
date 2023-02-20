<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=3) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");
    $bname = $_POST['bname'];
    $bemail = mysqli_real_escape_string($db,$_POST['bemail']);
    $phone = $_POST['phone'];
    $altphone = (isset($_POST['altphone'])) ? $_POST['altphone'] : "";
    $est = (isset($_POST['est'])) ? $_POST['est'] : "";
    $location = $_POST['location'];
    $address = $_POST['address'];
    $website = (isset($_POST['website'])) ? $_POST['website'] : "";
    $gstin = (isset($_POST['gstin'])) ? $_POST['gstin'] : "";
    $plan = $_POST['plan'];
    if(isset($_FILES['img_file'])) $img_file = $_FILES['img_file'];
    $users_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

    //change user_type

    if(isset($_FILES['img_file'])&&isset($_POST['submit'])){
        //upload image


        $currentDir = getcwd();
        $uploadDirectory = "/user_images/";

        $errors = []; // Store all foreseen and unforseen errors here

        $fileName = $_FILES['img_file']['name'];
        //$fileSize = $_FILES['img_file']['size'];
        $fileTmpName  = $_FILES['img_file']['tmp_name'];
        $fileType = $_FILES['img_file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = SITE_ROOT . $uploadDirectory . $users_id. "." . $fileExtension;
        $uploadedName = $users_id. "." . $fileExtension;
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
                $count = mysqli_num_rows($result);
                if($count<=0){
                    $insertSql = "INSERT INTO sellers (bname, email, phone, aphone, estab, location, address, website, gstin, plan, image, users_id)
                    VALUES ('$bname', '$bemail', '$phone', '$altphone', '$est', '$location', '$address', '$website', '$gstin', '$plan', '$uploadedName', '$users_id')";

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

                //db queries done
            } else {
                echo "An error occurred with file upload. Try again or contact the admin.";
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
            $insertSql = "INSERT INTO sellers (bname, email, phone, aphone, estab, location, address, website, gstin, plan, users_id)
            VALUES ('$bname', '$bemail', '$phone', '$altphone', '$est', '$location', '$address', '$website', '$gstin', '$plan', '$users_id')";

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

    /*
    //login
    $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($db,$sql);
    $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1){
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $row1['id'];
        header("location: /index.php");
    }
    else{
        header("location: /login.php?nomatch=true");
    }
    */

?>
