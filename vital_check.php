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
    <title>Document</title>
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div class="home_top">
        <h1>コミクト</h1>
    </div>
    <div class="home_top">
        <p class="home_top_text">ー 健康チェック ー</p>
    </div>
    <div class="home_button">
        <a class="button" href="vital_read.php">健康情報をみる</a>
    </div>
    <div class="home_button">
        <a class="button" href="vital.php">健康情報を入力する</a>
    </div>
    <div class="top">
        <a class="gohome" href=" member_home.php"><span>ホーム画面へ</span></a>
    </div>
</body>

</html>