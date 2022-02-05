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
        <p class="home_top_text">ー 利用者ホーム ー</p>
    </div>
    <div class="home_button">
        <a class="button" href="member_kaiwa.php">友達と話す</a>
    </div>
    <div class="home_button">
        <a class="button" href="vital_check.php">健康チェック</a>
    </div>
    <div class="home_button">
        <a class="button" href="member_input.php">基本情報入力</a>
    </div>

</body>

</html>