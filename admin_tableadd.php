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
    <title>コミクト（管理者ホーム）</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home_admin.css">
</head>

<body>
    <nav class="navbar navbar-light bg-success bg-opacity-25">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                <form class="d-flex fs-4">
                    <span class="navbar-text h5 ">
                        管理者:<?= $_SESSION['mbname'] ?>
                    </span>
                    <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col text-center my-5">
                <p class="h2">ー テーブル追加・変更 ー</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col text-center my-5">
                <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="admin_supporttable_read.php" role="button">支援者区分</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col text-center my-5">
                <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="admin_belongs_read.php" role="button">所属区分</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col text-center my-5">
                <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="admin_kaigo_read.php" role="button">介護区分</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col text-center my-5">
                <a class="btn btn-outline-danger rounded-pill btn-lg fs-3" style="width: 300px;;height:70px" href="admin_shougai_read.php" role="button">障がい区分</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center my-5">
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="admin_home.php" role="button">管理者ホームへ</a>
            </div>
        </div>
    </div>

</body>

</html>