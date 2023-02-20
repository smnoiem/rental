<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=2) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $bname = (isset($_POST['bname'])) ? $_POST['bname'] : "";
    $bemail = (isset($_POST['bemail'])) ? mysqli_real_escape_string($db,$_POST['bemail']) : "";
    $phone = (isset($_POST['phone'])) ? $_POST['phone'] : "";
    $altphone = (isset($_POST['altphone'])) ? $_POST['altphone'] : "";
    $est = (isset($_POST['est'])) ? $_POST['est'] : "";
    $location = $_POST['location'];
    $address = $_POST['address'];
    $website = (isset($_POST['website'])) ? $_POST['website'] : "";
    $gstin = (isset($_POST['gstin'])) ? $_POST['gstin'] : "";
    $plan = $_POST['plan'];
    if(isset($_FILES['img_file'])) $img_file = $_FILES['img_file'];
    $users_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

    if(isset($_FILES['img_file'])&&($_FILES['img_file']['error']<=0)&&isset($_POST['submit'])){
        //upload image

        //$currentDir = getcwd();
        $uploadDirectory = "/user_images/";

        $errors = [];

        $fileName = $_FILES['img_file']['name'];
        //$fileSize = $_FILES['img_file']['size'];
        $fileTmpName  = $_FILES['img_file']['tmp_name'];
        $fileType = $_FILES['img_file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = SITE_ROOT . $uploadDirectory . $users_id. "." . $fileExtension;
        $uploadedName = $users_id. "." . $fileExtension;
        //$uploadPath = $currentDir . $uploadDirectory . $users_id. "." . $fileExtension;
        //basename($fileName);

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                //image upload done
                //db queries start


                $sql = "SELECT * FROM sellers WHERE users_id = '$users_id' ";
                $result = mysqli_query($db,$sql);
                $count = mysqli_num_rows($result);
                if($count==1){
                    //UPDATE query
                    $updateSql = "UPDATE sellers SET bname='$bname', email='$bemail', phone='$phone', aphone='$altphone',
                    estab='$est', location='$location', address='$address', website='$website', gstin='$gstin', plan='$plan',
                    image='$uploadedName' WHERE users_id=$users_id";

                    if(mysqli_query($db, $updateSql)){
                        header("location: /seller-dashboard.php");
                    }
                    else {
                        echo("failed" . mysqli_error($db));
                        }
                }
                else{
                    header("location: /seller-dashboard.php?error='There is an issue with your user id.'");
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
        if($count==1){
            //UPDATE query
            $updateSql = "UPDATE sellers SET bname='$bname', email='$bemail', phone='$phone', aphone='$altphone',
            estab='$est', location='$location', address='$address', website='$website', gstin='$gstin', plan='$plan'
            WHERE users_id=$users_id";

            if(mysqli_query($db, $updateSql)){
                header("location: /seller-dashboard.php");
            }
            else {
                echo("failed" . mysqli_error($db));
                //header("location: /seller-register.php");
                }
        }
        else{
            header("location: /seller-dashboard.php?error='There is an issue with your user id.'");
        }
    }

    //echo("$bemail $bname $users_id $website\n");

?>
