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
    <title>こみくと（利用者ホーム）</title>
</head>

<body>
    <header>
        <div>
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
    <div>
        <h1>こみくと</h1>
        <p>ー 利用者ホーム ー</p>
    </div>
    <div>
        <a class="button">友達と話す</a>
    </div>
    <div>
        <a class="button" href="vital_check.php">健康チェック</a>
    </div>
    <div>
        <a class="button" href="member_input.php">基本情報入力</a>
    </div>
    <p><a href="logout.php">ログアウト</a></p>
</body>

</html>