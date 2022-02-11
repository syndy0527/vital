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
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
        <div class="home_head_text">
            <p><a href="logout.php">ログアウト</a></p>
        </div>
    </header>
    <div class="home_top">
        <h1>コミクト</h1>
    </div>
    <div class="home_top">
        <p class="home_top_text">ー 基本情報入力 ー</p>
    </div>
    <div class="home_button">
        <a class="button" href="member.php">基本情報</a>
    </div>
    <div class="home_button">
        <a class="button" href="member_sinzoku.php">親族情報</a>
    </div>
    <div class="home_button">
        <a class="button" href="member_medical.php">医療情報</a>
    </div>
    <div class="top">
        <a class="gohome" href=" member_home.php"><span>ホーム画面へ</span></a>
    </div>
</body>

</html>