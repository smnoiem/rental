<?php
    include("conn.php");

    if(isset($_GET['cat'])){
        $cat=$_GET['cat'];
        $catQ = "SELECT * FROM category WHERE id=$cat";
        $catR = mysqli_query($db,$catQ);
        $cat="";
        while($catRow = mysqli_fetch_array($catR, MYSQLI_ASSOC)){
            $cat = $catRow['catkey'];
        }

        if(isset($_GET['subcat'])){
            $subcat = $_GET['subcat'];
            $subcatQ = "SELECT * FROM subcategory WHERE id=$subcat";
            $subcatR = mysqli_query($db,$subcatQ);
            $subcat="";
            while($subcatRow = mysqli_fetch_array($subcatR, MYSQLI_ASSOC)){
                $subcat = $subcatRow['subcatkey'];
            }
            if(isset($_GET['loc'])){
                $loc = $_GET['loc'];
                $locQ = "SELECT * FROM location WHERE id=$loc";
                $locR = mysqli_query($db,$locQ);
                $loc="";
                while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
                    $loc = $locRow['lockey'];
                }
                if($subcat!="") header("Location: /products/$cat/$subcat/$loc");
                else header("Location: /products/$cat/$loc");
            }
            else{
                if($subcat!="") header("Location: /products/$cat/$subcat");
                else header("Location: /products/$cat");
            }

        }
        else{
            if(isset($_GET['loc'])){
                $loc = $_GET['loc'];
                $locQ = "SELECT * FROM location WHERE id=$loc";
                $locR = mysqli_query($db,$locQ);
                $loc="";
                while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
                    $loc = $locRow['lockey'];
                }
                if($loc!="") header("Location: /products/$cat/$loc");
                else header("Location: /products/$cat");
            }
            else if($cat!="") header("Location: /products/$cat");
            else header("Location: /products.php");
        }

    }
    else if(isset($_GET['loc'])){
        $loc = $_GET['loc'];
        $locQ = "SELECT * FROM location WHERE id=$loc";
        $locR = mysqli_query($db,$locQ);
        $loc="";
        while($locRow = mysqli_fetch_array($locR, MYSQLI_ASSOC)){
            $loc = $locRow['lockey'];
        }
        if($loc!="") header("Location: /products/$loc");
        else header("Location: /products.php");
    }
    else header("Location: /products.php");
?>
