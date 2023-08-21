<?php 
    session_start();
    require_once 'database.php';
    if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            $phone = $_SESSION["phone"];
            $sql5 = "SELECT id FROM users WHERE phone = '$phone'";
            $res = mysqli_query($conn,$sql5);
            $info = $res->fetch_array()['id'];
            $user_id = $info["id"];

            $sql10 = "SELECT * FROM follower WHERE user_id=$user_id AND follow_id=$id";
            $r = $res = mysqli_query($conn,$sql5);
            if (mysqli_num_rows($r) < 1 || ($id != $user_id)){
                if (mysqli_num_rows($result) === 1){
                    $row = mysqli_fetch_assoc($result);
                    $liked = (int)$row['follower'] + 1;
                    $sql2 = "UPDATE users SET follower=$liked WHERE id=$id";
                    $reslt = mysqli_query($conn,$sql2);
                    if ($reslt){
                        $sql1 = "INSERT INTO follower (follow_id,usẻ_id) VALUES ($post_id,$user_id)";
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
                    $liked = (int)$row['follower'] - 1;
                    $sql2 = "UPDATE users SET follower=$liked WHERE id=$id";
                    $reslt = mysqli_query($conn,$sql2);
                    if ($reslt){
                        $sql1 = "DELETE FROM follower WHERE user_id=$user_id AND follow_id=$id;";
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