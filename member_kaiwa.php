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
        <p>ー 友達と話す ー</p>
    </div>
    <div>
        <a class="button">顔を見て話す</a>
    </div>
    <div>
        <a class="button" href="member_mail.php">メールする</a>
    </div>
    <div>
        <a class="button">写真を送る</a>
    </div>
    <div>
        <a class="button" href="member_friend_add.html">友達を追加する</a>
    </div>
    <p><a href=" member_home.php">ホーム画面へ</a></p>

</html>