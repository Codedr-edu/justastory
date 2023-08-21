<?php 
    session_start();
    if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
        require_once 'database.php';
        if(isset($_GET['comment_id'])){
            $post_id = (int)$_GET['post_id'];
            $sql = "SELECT * FROM post WHERE id=$post_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                $liked = (int)$row['disliked'] + 1;
                $sql2 = "UPDATE comment SET disliked=$liked WHERE id=$post_id";
                $result = mysqli_query($conn,$sql2);
                if ($res){
                    header("Location: detail.php?id=$post_id");
                }
                else{
                    header('Location: error.php?code="ko like dc"');
                }
            }
        }
    }
?>