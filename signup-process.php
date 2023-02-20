<?php
    include("conn.php");
    session_start();

    $fname = mysqli_real_escape_string($db,$_POST['fname']);
    $lname = mysqli_real_escape_string($db,$_POST['lname']);
    $p1 = mysqli_real_escape_string($db,$_POST['password']);
    $p2 = mysqli_real_escape_string($db,$_POST['confirm']);
    $email = $_POST['email'];
    //echo("$fname $lname $p1 $p2 $email\n");

    if(!isset($_SESSION['login_user'])){

        //check if email already registered
        $usQ = "SELECT email FROM users WHERE email='$email'";
        $usR = mysqli_query($db, $usQ);
        if(mysqli_num_rows($usR)<=0){


            if($p1==$p2){
                $pwdH = password_hash($p1, PASSWORD_DEFAULT);

                $reg="INSERT INTO users(fname, lname, password, email )
                VALUES('$fname',  '$lname', '$pwdH', '$email' )";
                if($db->query($reg)==TRUE){
                    //login
                      $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pwdH'";
                      $result = mysqli_query($db,$sql);
                      $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
                      $count = mysqli_num_rows($result);
                      if($count==1){
                            $_SESSION['email'] = $email;
                            $_SESSION['id'] = $row1['id'];
                            $_SESSION['user_type'] = $row1['user_type'];
                            $_SESSION['fname'] = $fname;
                            $_SESSION['lname'] = $lname;
                            header("location: /index.php");
                      }
                }
                else{
                    echo("something went wrong. " . mysqli_connect_errno($db) );
                }
            }
            else echo("passwords do not match");
        }
        else echo("email already registered.");
    }

?>
