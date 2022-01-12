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
            <p>管理者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div>
        <h1>こみくと</h1>
        <p>ー 管理者ホーム ー</p>
    </div>
    <div>
        <a class="button" href="member_read.php">利用者情報照会</a>
    </div>
    <p><a href="logout.php">ログアウト</a></p>
</body>

</html>