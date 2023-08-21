<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <style>
        .btn-light{
            color:#042A2B
        }
        .btn-outline-light{
            color:#F4EDED;
            border: 2px solid #F4EDED;
        }
        .navbar{
            box-shadow: none;
        }
        .btn-green{
          background-color: #3A8038;
          color:#F4EDED;
        }
        .btn-green:hover{
          background-color: transparent;
          color:#3A8038;
          border: 2px solid #3A8038;
        }
        .btn-outline-green{
          border: 2px solid #042A2B;
          color: #042A2B;
        }
        .btn-outline-green:hover{
          border: 2px solid #042A2B;
          color: #F4EDED;
          background-color: #042A2B;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #3A8038;">
            <!-- Container wrapper -->
            <div class="container">
              <!-- Navbar brand -->
              <a class="navbar-brand " href="https://mdbgo.com/">
                <h4 class="title is-4 text-light" style="margin-top:2px;">Just a Story</h4>
              </a>

              <!-- Toggle button -->
              <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <i class="fas fa-bars"></i>
              </button>

              <!-- Collapsible wrapper -->
              <div style="margin-top: 1px;" class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Demo</a>
                  </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center">
                  <a href="" type="button" class="btn btn-outline-light px-3 me-2">
                    Tài khoản
                  </a>
                </div>
              </div>
              <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
          </nav>
    </header>
    <main>
        <div class="container">
            <br>
            <?php 
                require_once 'database.php';
                if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
                    $phone = $_SESSION["phone"];

                    $sql = "SELECT * FROM users WHERE  phone = '$phone'";
                    $res = mysqli_query($conn,$sql);
                    $info = mysqli_fetch_assoc($res);

                    echo '<div class="columns">
                            <div class="column">
                              <h1 class="title is-1 text-start">Người Dùng: '.$info['username'].'</h1>
                            </div>
                            <div class="column">
                              <p class="title is-6 text-end">Email: '.$info['email'].'</p>
                              <p class="title is-6 text-end">Điện Thoại: '.$info['phone'].'</p>
                              <p class="title is-6 text-end">Lớp: '.$info['class'].'</p>
                            </div>
                          </div>  
                    <a class="btn btn-green w-100" style="margin-bottom:10px;" href="follow.php?id='.$info['id'].'">Follow</a>';
                    
                }
                else {
                    header("Location: login.php");
                }

            ?>
            <br>
                    <?php 
                    if (isset($_GET['id'])){
                        $type = $_GET['id'];
                        $query = "SELECT * FROM post WHERE user_id=$type ORDER BY date DESC";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                if ((int)$row['down'] < 1000){
                          echo' <div class="card shadow-lg rounded">
                                  <div class="card-body">
                                    <h3 class="title is-3" style="margin-top:10px;margin-bottom:15px;" id="'.$row['id'].'"><a class="link-success" href="detail.php?id=' .$row['id'].'">'.$row['title']. '</a></h3>';
                            echo '  <p style="margin-bottom:15px;letter-spacing: 1px;">' .$row['content']. '</p>';
                            echo '  <p style="margin-bottom:15px;"> Tác giả: '.$row['user_name']. ' - Thể Loại: ' .$row['code']. ' - Đăng Lúc: ' .$row['date']. '</p>';
                            echo   '<div class="columns">
                                        <div class="column">
                                            <a href="liked.php?&post_id='.$row['id'].'" class="btn btn-primary w-100"> Lượt Ủng Hộ: '.$row['liked'].'</a>
                                        </div>
                                        <div class="column">
                                            <a href="disliked.php?&post_id='.$row['id'].'" class="btn btn-green w-100"> Lượt Phản Đối: '.$row['disliked'].'</a>
                                        </div>
                                    </div>';
                            echo  ' <div class="columns">
                                      <div class="column">
                                          <a href="down.php?&post_id='.$row['id'].'" class="btn btn-green w-100"> Báo Cáo: '.$row['down'].'</a>
                                      </div>
                                    </div>';
                            echo    '<p class="text-start">Bình Luận: '.$row['comment_counter'].'</p>
                                    <form action="comment.php" method="GET" enctype="multipart/form-data"><div class="mb-3 form-group"><input type="number" name="post_id" id="post_id" value="'.$row['id'].'" hidden><input type="text" placeholder="Bình Luận" value="" class="form-control shadow" id="comment" name="comment"/></div><input name="submit" placeholder="Bình Luận" type="submit" class="btn btn-green shadow w-100" style="margin-top: 20px;" value="Bình Luận"/></form>
                                    <br><br>
                                  </div>
                                </div>';
                                        }
                                    }
                                }
                                else {
                                    echo '<h1 class="text-center title is-3">Chưa có bài nào cả! Đăng đê bạn ơi</h1>';
                                }
                        }
                    ?>
        </div>
    </main>
    <footer class="fixed-bottom" style="margin-bottom: 10px;">
        <div class="container">
          <p class="text-center text-muted">Bản quyền thuộc về Codedr(Hoàng Hùng Anh)</p>
        </div>
    </footer>
</body>
</html>
