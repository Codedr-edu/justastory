<?php 
  session_start();
  if ($_SESSION["loggedin"] == true && $_SESSION["phone"]){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            require_once 'database.php';
            if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['code'])){
                $title = $_POST['title'];
                $content = $_POST['content'];
                $code = $_POST['code'];
                $phone = $_SESSION["phone"];
                $follow = 0;

                $sql2 = "SELECT * FROM users WHERE phone = '$phone'";
                $res = mysqli_query($conn,$sql2);
                $info = mysqli_fetch_array($res);
                $creator = $info['username'];
                $create_id = $info['id'];
                $sql = "INSERT INTO post (title, content, code, user_name, user_id, liked, disliked, down, comment_counter) VALUES ('$title', '$content', '$code', 'Ẩn Danh', 0, 0, $follow, $follow, $follow)";
                echo $sql;
                $query = mysqli_query($conn,$sql);
                if ($query){
                    echo"ok";
                    header("Location: dashboard.php");
                }
                else{
                    echo"Error";
                }
                mysqli_close($conn);
            }
        }
}

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
                    <a class="nav-link" href="#">Source code preview</a>
                  </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center">
                  <a href="" type="button" class="btn btn-outline-light px-3 me-2">
                    Want a website?
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
            <div class="d-flex aligns-items-center shadow justify-content-center card text-center w-75 mx-auto" style="margin-top: 50px;">
                <div class="card-body">
                 <div class="conatiner">
                    <br>
                      <h1 class="title is-1 text-center">Đăng Bài</h1>
                      <br>
                      <form action="security.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 form-group">
                          <div class="mb-3 form-group">
                            <label for="title" class="form-label text-dark">Tiêu Đề</label>
                            <br>
                            <input type="text" class="form-control shadow" id="title" name="title"/>
                          </div>
                          <div class="mb-3 form-group">
                            <label for="content"  class="form-label text-dark">Nội Dung</label>
                            <br>
                            <textarea id="content" class="form-control shadow" name="content" rows="4" cols="50"></textarea>
                          </div>
                          <div class="mb-3 form-group">
                            <label for="code" class="form-label text-dark">Thể Loại</label>
                            <br>
                            <input type="text" class="form-control shadow" id="code" name="code"/>
                          </div>
                        <input name="submit" type="submit" class="btn btn-green shadow w-100" style="margin-top: 20px;" value="Đăng">
                    </form>
                 </div>
                </div>
              </div>
        </div>
    </main>
    <footer class="fixed-bottom" style="margin-bottom: 10px;">
        <div class="container">
          <p class="text-center text-muted">Bản quyền thuộc về Codedr(Hoàng Hùng Anh)</p>
        </div>
    </footer>
</body>
</html>