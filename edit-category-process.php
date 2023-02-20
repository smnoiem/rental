<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['catkey'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==1){
        $catId = $_POST['id'];
        $cat = $_POST['name'];
        $catkey = $_POST['catkey'];
        $catkey = strtolower(str_replace(' ', '', $catkey));
        $catQ = "SELECT * FROM category WHERE id = $catId";
        $catR = mysqli_query($db, $catQ);
        $catRow = mysqli_fetch_array($catR, MYSQLI_ASSOC);

        if(isset($_FILES['img_file'])&&($_FILES['img_file']['error']<=0)&&isset($_POST['submit'])){
            //upload image

            $uploadDirectory = "/assets/img/category/";

            $errors = [];

            $fileName = $_FILES['img_file']['name'];
            //$fileSize = $_FILES['img_file']['size'];
            $fileTmpName  = $_FILES['img_file']['tmp_name'];
            $fileType = $_FILES['img_file']['type'];
            $fileExtension = strtolower(end(explode('.',$fileName)));

            if(isset($catRow['icon'])&&$catRow['icon']!=""){
                $uploadPath = SITE_ROOT . $uploadDirectory . $catRow['icon'];
                $uploadedName = $catRow['icon'];
            }
            else {
                $uploadPath = SITE_ROOT . $uploadDirectory . $catkey. "." . $fileExtension;
                $uploadedName = $catkey. "." . $fileExtension;
            }

            if (empty($errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                if ($didUpload) {
                    //image upload done
                    //db queries start
                    //INSERT query
                    $updateQ = "UPDATE category SET category='$cat', icon='$uploadedName', catkey = '$catkey'
                    WHERE id=$catId";

                    if(mysqli_query($db, $updateQ)) header("Location: show-category.php?msg=Category Updated Successfully");
                    else  header("Location: show-category.php?msg=Category Update Failed");

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

            $updateQ = "UPDATE category SET category='$cat', catkey='$catkey' WHERE id=$catId";
            if(mysqli_query($db, $updateQ)) header("Location: show-category.php?msg=Category Updated Successfully");
            else  header("Location: show-category.php?msg=Category Update Failed");

        }
        else header("Location: seller-dashboard.php");
    }
    else header("Location: seller-dashboard.php");

?>
