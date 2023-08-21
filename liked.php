<?php 
    session_start();
    require_once 'database.php';
    if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
        if(isset($_GET['post_id'])){
            $post_id = (int)$_GET['post_id'];
            $sql = "SELECT * FROM post WHERE id=$post_id";
            $result = mysqli_query($conn, $sql);

            $phone = $_SESSION["phone"];
            $sql5 = "SELECT id FROM users WHERE phone = '$phone'";
            $res = mysqli_query($conn,$sql5);
            $info = $res->fetch_array()['id'];
            $user_id = $info["id"];

            $sql10 = "SELECT * FROM liked WHERE user_id=$user_id AND post_id=$post_id";
            $r = $res = mysqli_query($conn,$sql5);
            if (mysqli_num_rows($r) < 1){
                if (mysqli_num_rows($result) === 1){
                    $row = mysqli_fetch_assoc($result);
                    $liked = (int)$row['liked'] + 1;
                    $sql2 = "UPDATE post SET liked=$liked WHERE id=$post_id";
                    $reslt = mysqli_query($conn,$sql2);
                    if ($reslt){
                        $sql1 = "INSERT INTO liked (post_id,user_id) VALUES ($post_id,$user_id)";
                        $res = mysqli_query($conn,$sql1);
                        if ($res){
                            header("Location: detail.php?id=$post_id");
                        }
                    }
                    else{
                        header('Location: error.php?code="ko like dc"');
                    }
                }
            }
            else {
                $row = mysqli_fetch_assoc($result);
                    $liked = (int)$row['liked'] - 1;
                    $sql2 = "UPDATE post SET liked=$liked WHERE id=$post_id";
                    $reslt = mysqli_query($conn,$sql2);
                    if ($reslt){
                        $sql1 = "DELETE FROM liked WHERE user_id=$user_id AND post_id=$post_id;";
                        $res = mysqli_query($conn,$sql1);
                        if ($res){
                            header("Location: detail.php?id=$post_id");
                        }
                    }
                    else{
                        header('Location: error.php?code="ko like dc"');
                    }
            }
        }
    }
?>