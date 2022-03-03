<?php
session_start();
include("functions.php");
check_session_id();
$id = $_SESSION['member_id'];
$pdo = connect_to_db();

$sql = "SELECT friend_table.member_id,friend_table.friend_id,mbname FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id WHERE friend_table.member_id=$id;";

$stmt = $pdo->prepare($sql);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = "";
foreach ($result as $record) {
    // var_dump($record);
    // exit();
    $output .= "<p><a href='member_mail.php?id={$record['friend_id']}'>{$record['mbname']}</a> </p>";
};

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール先一覧</title>
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
    <fieldset>
        <legend>友達一覧</legend>
        <table>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset>

    <div class="top_content">
        <div class="top">
            <a class="gohome" href=" member_kaiwa.php"><span>友達と話すへ</span></a>
        </div>
        <div class="top">
            <a class="gohome" href="member_mail_select.php"><span>友達一覧へ</span></a>
        </div>
    </div>
</body>

</html>