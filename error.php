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
    <div class="container">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <img src="static/undraw_warning_re_eoyh.svg" alt="Error_Image" loading="lazy" />
                <?php 
                session_start();
                if (isset($_GET['error'])){
                    echo '<h1 class="title is-1">'.$_GET['error'].'</a>';
                    if ($_SESSION['loggedin'] == true && $_SESSION['phone']){
                        echo '<a class="btn btn-green w-100">Về trang chủ</a>';
                    }
                    else {
                        echo '<a class="btn btn-green w-100">Về trang đăng nhập</a>';
                    }
                }
                else {
                    echo '<h1 class="title is-1"> Lỗi không xác định </h1>';
                    if ($_SESSION['loggedin'] == true && $_SESSION['phone']){
                        echo '<a class="btn btn-green w-100">Về trang chủ</a>';
                    }
                    else {
                        echo '<a class="btn btn-green w-100">Về trang đăng nhập</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>