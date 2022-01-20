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
</head>

<body>
    <header>
        <div>
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div>
        <h1>こみくと</h1>
        <p>ー 健康チェック ー</p>
    </div>
    <div>
        <a class="button" href="vital_read.php">健康情報をみる</a>
    </div>
    <div>
        <a class="button" href="vital.php">健康情報を入力する</a>
    </div>
    <p><a href="member_home.php">ホーム画面へ</a></p>
</body>

</html>