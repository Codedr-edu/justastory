<?php
session_start();
if ($_SESSION["loggedin"]){
    $_SESSION["loggedin"] = false;
    $_SESSION["phone"] = "0000000";
    header("Location: login.php");
} 
else {
    header("Location: login.php");
}
?>