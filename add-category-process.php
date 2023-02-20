<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_POST['name'])&&isset($_FILES['img_file'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==1){
        $cat = $_POST['name'];
        $catkey = $_POST['name'];
        $catkey = strtolower(str_replace(' ', '', $catkey));
        $catQ = "SELECT * FROM category WHERE category='$cat' or catkey='$catkey'";
        $catR = mysqli_query($db, $catQ);
        $num = mysqli_num_rows($catR);
        if($num>0) header("Location: show-category.php?msg=Duplicate Found! Try Another.");
        else{



            if(isset($_FILES['img_file'])&&($_FILES['img_file']['error']<=0)&&isset($_POST['submit'])){
                //upload image

                $uploadDirectory = "/assets/img/category/";

                $errors = [];

                $fileName = $_FILES['img_file']['name'];
                //$fileSize = $_FILES['img_file']['size'];
                $fileTmpName  = $_FILES['img_file']['tmp_name'];
                $fileType = $_FILES['img_file']['type'];
                $fileExtension = strtolower(end(explode('.',$fileName)));

                $uploadPath = SITE_ROOT . $uploadDirectory . $catkey. "." . $fileExtension;
                $uploadedName = $catkey. "." . $fileExtension;
                //$uploadPath = $currentDir . $uploadDirectory . $users_id. "." . $fileExtension;
                //basename($fileName);

                if (empty($errors)) {
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                    if ($didUpload) {
                        //image upload done
                        //db queries start
                        //INSERT query
                        $insQ = "INSERT INTO category(category, icon, catkey)
                        VALUES ('$cat', '$uploadedName', '$catkey')";

                        if(mysqli_query($db, $insQ)) header("Location: show-category.php?msg=Category Added Successfully");
                        else  header("Location: show-category.php?msg=Category Adding Failed");

                        //db queries done
                    } else {
                        echo "An error occurred with file upload.";
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

                $insQ = "INSERT INTO category(category, catkey)
                VALUES ('$cat', '$catkey')";

                if(mysqli_query($db, $insQ)) header("Location: show-category.php?msg=Category Added Successfully");
                else  header("Location: show-category.php?msg=Category Adding Failed");

            }
            else header("Location: seller-dashboard.php");
        }
    }
    else header("Location: seller-dashboard.php");

?>
