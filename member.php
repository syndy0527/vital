<?php
// DB接続
// 各種項目設定
$dbn = 'mysql:dbname=sotusei_07;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

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
    $output .= "<tr><td>{$record['memberID']}</td><td>{$record['mbname']}</td><td>{$record['seibetu']}</td><td>{$record['barthday']}</td><td>{$record['mbaddress']}</td>><tr>";
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
    <form action="member_create.php" method="POST">
        <fieldset>
            <legend>メンバー登録</legend>
            <div>
                氏名：<input type="text" name="mbname">
            </div>
            <div>
                性別：<select name="seibetu">
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </div>
            <div>
                生年月日：<input type="date" name="barthday">
            </div>
            <div>
                住所：<input type="text" name="address">
            </div>
            <div>
                <button>submit</button>
            </div>
        </fieldset>
        <fieldset>
            <legend>会員一覧</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>性別</th>
                        <th>生年月日</th>
                        <th>住所</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $output ?>
                </tbody>
            </table>
        </fieldset>

    </form>

</body>

</html>