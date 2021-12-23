<?php
// var_dump($_GET);
// exit();
// id受け取り
$id = $_GET["id"];
// DB接続
include('functions.php');
$pdo = connect_to_db();
// SQL実行
$sql = 'SELECT * FROM member_table WHERE memberId=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($record);
// exit();
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
    <form action="member_update.php" method="POST">
        <fieldset>
            <legend>住所変更</legend>
            <a href="member_read.php">一覧画面</a>
            <div>
                住所: <input type="text" name="mbaddress" value="<?= $record["mbaddress"] ?>">
            </div>
            <input type="hidden" name="id" value="<?= $record["memberID"] ?>">
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>
</body>

</html>