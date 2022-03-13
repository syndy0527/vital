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
    <title>コミクト（利用者ホーム）</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-danger bg-opacity-25">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                    <form class="d-flex fs-4">
                        <span class="navbar-text h5 ">
                            利用者:<?= $_SESSION['mbname'] ?>
                        </span>
                        <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                    </form>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="col text-center my-5">
                    <p class="h2">ー 利用者ホーム ー</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center  ">
                <div class="col text-center my-5 align-items-center">
                    <a class="btn btn-outline-danger rounded-pill btn-lg fs-3 " style="width: 300px;;height:70px" href="member_kaiwa.php" role="button">テレビ電話</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center my-5">
                    <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="vital_check.php" role="button">健康チェック</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center my-5">
                    <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="member_input.php" role="button">基本情報入力</a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>