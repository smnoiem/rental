<?php
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    include("conn.php");
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type']!=1) header("Location: /user-dashboard.php");
    }
    else header("Location: /login.php");

    $name = (isset($_POST['name'])) ? $_POST['name'] : "";
    $cat = (isset($_POST['cat'])) ? $_POST['cat'] : "";
    $subcat = (isset($_POST['subcat'])) ? $_POST['subcat'] : "";
    $location = $_POST['location'];
    $description = (isset($_POST['description'])) ? $_POST['description'] : "";

    if(isset($_FILES['img_file'])) $img_file = $_FILES['img_file'];

    $ads_id = (isset($_POST['id'])) ? $_POST['id'] : "";

    $adsQ = "SELECT users_id, image FROM ads WHERE id='$ads_id' ";
    $adsR = mysqli_query($db, $adsQ);
    $adsRow = mysqli_fetch_array($adsR, MYSQLI_ASSOC);

    if(isset($_POST['submit'])&&mysqli_num_rows($adsR)==1){

        //upload image
        if(isset($_FILES['img_file'])&&($_FILES['img_file']['error']<=0)){
            //$currentDir = getcwd();
            $uploadDirectory = "/post_images/";


            $errors = [];

            $fileName = $_FILES['img_file']['name'];
            $fileTmpName  = $_FILES['img_file']['tmp_name'];
            $fileType = $_FILES['img_file']['type'];
            $fileExtension = strtolower(end(explode('.',$fileName)));


            $imageName = (isset($adsRow['image'])) ? $adsRow['image'] : "";
            if(isset($adsRow['image'])&&$imageName!=""){
                $file = SITE_ROOT . $uploadDirectory . $imageName;
                if (file_exists($file)&&is_writable($file)) {
                    unlink($file);
                }
                $didUpload = move_uploaded_file($fileTmpName, $file);

                if ($didUpload) {
                    //image upload done
                }
                else{
                    echo "An error occurred with file upload. Try again or contact the admin";
                }
            }
            else{

                $myrand = rand();
                $fpname = $name;
                //preg_replace("/(#\w+)/", "_", $fpname);
                $fpname = preg_replace('/\s+/', '_', $fpname);


                $file = SITE_ROOT . $uploadDirectory . $fpname . $myrand. "." . $fileExtension;
                $imageName = $fpname . $myrand . "." . $fileExtension;

                $didUpload = move_uploaded_file($fileTmpName, $file);

                if ($didUpload) {
                    //image upload done
                }
                else{
                    echo "An error occurred with file upload. Try again or contact the admin";
                }
            }

            $updateSql = "UPDATE ads SET title='$name', category='$cat', sub_category='$subcat',
            location='$location', details='$description', image='$imageName' WHERE id=$ads_id";

        }
        else{

            $updateSql = "UPDATE ads SET title='$name', category='$cat', sub_category='$subcat',
            location='$location', details='$description' WHERE id=$ads_id";
        }

        //db queries start

        if($_SESSION['user_type']==1){
            //UPDATE query

            if(mysqli_query($db, $updateSql)){
                header("location: /admin-dashboard.php");
            }
            else {
                echo("failed" . mysqli_error($db));
                }
        }
        else{
            header("location: /admin-dashboard.php?error='There is an issue with your user id.'");
        }

        //db queries done
    }

    //echo("$bemail $bname $users_id $website\n");

?>
