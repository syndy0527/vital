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
    <title>こみくと（支援者ホーム）</title>
</head>

<body>
    <header>
        <div>
            <p>支援者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div>
        <h1>こみくと</h1>
        <p>ー 支援者ホーム ー</p>
    </div>
    <div>
        <a class="button">見守り情報照会</a>
    </div>
    <div>
        <a class="button">見守り情報入力</a>
    </div>
    <div>
        <a class="button" href="sien_base.php">支援者基本情報入力</a>
    </div>
    <p><a href="logout.php">ログアウト</a></p>
</body>

</html>