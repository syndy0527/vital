<?php
// DB接続
// 各種項目設定
include('functions.php');

// DB接続
$pdo = connect_to_db();


$sql = 'SELECT * FROM member_table ORDER BY memberID ASC';

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
    $output .= "<tr><td>{$record['memberID']}</td><td>{$record['mbname']}</td><td>{$record['seibetu']}</td><td>{$record['barthday']}</td><td>{$record['mbaddress']}</td><td>
        <a href='member_edit.php?id={$record["memberID"]}'>edit</a>
      </td>
      <td>
        <a href='member_delete.php?id={$record["memberID"]}'>delete</a>
      </td><tr>";
}
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
        <legend>会員一覧</legend>
        <a href="member.php">登録画面</a>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>性別</th>
                    <th>生年月日</th>
                    <th>住所</th>
                    <th>住所変更</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset>

</body>

</html>