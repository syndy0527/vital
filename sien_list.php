<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
// DB接続
$pdo = connect_to_db();


$sql = "SELECT sien_table.member_id,mbname FROM `sien_table` LEFT OUTER JOIN member_table ON sien_table.sien_id=member_table.member_id WHERE sien_table.member_id=$id;";

$stmt = $pdo->prepare($sql);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
$output = "";
foreach ($result as $record) {
    $output .= "<tr><td>{$record['mbname']}</td><tr>";
};
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支援対象者一覧</title>
    <link rel="stylesheet" href="css/style_sien_page.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>支援者:
                <?= $_SESSION['mbname'] ?>
            </p>
        </div>
        <div class="home_head_text">
            <p><a href="logout.php">ログアウト</a></p>
        </div>

    </header>
    <div class="field_main">
        <fieldset class="field_set">
            <legend>支援対象者一覧</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>支援対象者</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $output ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="top_content">
        <div class="top">
            <a class="gohome" href=" sien_home.php"><span>支援者ホームへ</span></a>
        </div>
    </div>
</body>

</html>