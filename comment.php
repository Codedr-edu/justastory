<?php
    session_start();
    require_once 'database.php';
    if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
        if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['post_id']) && isset($_GET['comment'])){
            $comment = $_GET['comment'];
            $pot_id = $_GET['post_id'];
            echo $comment,$pot_id;

            $phone = $_SESSION["phone"];

            $sql = "SELECT * FROM users WHERE phone = '$phone'";
            $resu = mysqli_query($conn,$sql);
            $info = mysqli_fetch_assoc($resu);


            $follow = 0;
            $userid = $info['id'];
            $username = $info['username'];
            $sql1 = "INSERT INTO comment (post_id,user_id,content,liked,disliked,down,user_name) VALUES ($pot_id,$userid,'$comment',$follow,$follow,$follow,'$username')";
            $res = mysqli_query($conn,$sql1);
            if ($res){
              $sql3 = "SELECT * FROM post WHERE id=$pot_id";
              $result = mysqli_query($conn, $sql3);
              if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                $liked = (int)$row['liked'] + 1;
                $sql2 = "UPDATE post SET comment_counter=$liked WHERE id=$pot_id";
                $r = mysqli_query($conn, $sql2);
                if ($r){
                  header("Location: detail.php?id=$pot_id");
                }
                else{
                  header("Location: error.php?error='ko comment dc'");
                }
              }
            }
            else{
              header("Location: error.php?error='ko comment dc'");
            }
        }
    }
        

?>