<?php
    include("conn.php");
    session_start();

    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $remember = "";
    if(isset($_POST['remember'])) $remember = $_POST['remember'];

    //login
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db,$sql);
    $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1){
        $savedPass = $row1['password'];
        if(password_verify($password, $savedPass)) {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $row1['id'];
            $_SESSION['user_type'] = $row1['user_type'];
            $_SESSION['fname'] = $row1['fname'];
            $_SESSION['lname'] = $row1['lname'];

            header("location: /index.php");
        }
        else{
            header("location: /login.php?nomatch=true");
        }

    }
    else{
        header("location: /login.php?nomatch=true");
    }

?>
