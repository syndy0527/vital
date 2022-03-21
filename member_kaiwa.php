<?php
include("functions.php");
session_start();
check_session_id();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>友達と話す</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-danger bg-opacity-25">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="img/comictlogo.png" alt="" width="250" height="60" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-dark fw-bold fs-4" href="#">利用者:<?= $_SESSION['mbname'] ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary text-white fs-5 " href="logout.php" role="button">ログアウト</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="mb-5">
            <div class="container-fluid">
                <div class="row justify-content-center ">
                    <div class="col text-center my-5">
                        <p class="h2">ー テレビ電話 ー</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center  ">
                    <div class="col text-center my-4">
                        <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="skyway_main.php" role="button">友達と話す</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col text-center my-4">
                        <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="skyway_main_sien.php" role="button">支援者と話す</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col text-center my-4">
                        <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="member_friend_list.php" role="button">友達一覧</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col text-center my-5">
                        <a class="btn btn-secondary btn-lg fs-5" style="width: 150px;;height:50px" href="member_home.php" role="button">ホーム画面へ</a>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
            <div class="container">
                <p>&copy;2022 syndy </p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>