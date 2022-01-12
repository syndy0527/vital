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
    <title>基本情報入力</title>
</head>

<body>
    <header>
        <div>
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div>
        <h1>こみくと</h1>
        <p>ー 基本情報入力 ー</p>
    </div>
    <div>
        <a class="button" href="member.php">基本情報</a>
    </div>
    <div>
        <a class="button">親族情報</a>
    </div>
    <div>
        <a class="button">医療情報</a>
    </div>
    <p><a href="member_home.php">ホーム画面へ</a></p>

</body>

</html>