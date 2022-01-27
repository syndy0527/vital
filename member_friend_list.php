<?php
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = "SELECT friend_table.member_id,mbname FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id;";

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
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend>友達一覧</legend>
        <a href="member_kaiwa.php">友達と話すへ</a>
        <table border="1">
            <thead>
                <tr>
                    <th>友達</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset>
</body>

</html>