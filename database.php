<?php

    $db_server = "127.0.0.1";
    $db_user = "root";
    $db_pass = "";
    $db_name = "bussiness";
    $conn = "";


    try{
        $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_pass);
        mysqli_select_db($conn, $db_name);
    }
    catch(mysqli_sql_exception){
        echo"No";
    }
 ?>