<?php
session_start();
require_once 'database.php';
if ($_SESSION["loggedin"] == true and $_SESSION["phone"]){
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])){
        $search = $_GET["search"];
        header("Location: search_result.php?search='$search'");

    }
}
?>