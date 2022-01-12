<?php
// var_dump($_GET);
// exit();
// id受け取り

$id = $_GET["id"];
// DB接続
include('functions.php');
session_start();
check_session_id();
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
            <legend>変更</legend>
            <a href="member_read.php">一覧画面</a>
            <div>
                住所: <input type="text" name="mbaddress">
                <p> 登録状況：<?= $record["mbaddress"] ?></p>
            </div>
            <div>
                利用者区分: <select name="admin">
                    <option value="0">一般</option>
                    <option value="1">支援者</option>
                    <option value="2">管理者</option>
                </select>
                <p> 登録状況：<span id="admin"></span></p>
            </div>
            <div>
                停止区分: <select name="delete">
                    <option value="0">利用中</option>
                    <option value="1">利用停止</option>
                </select>
                <p> 登録状況：<span id="delete"></span></p>
            </div>
            <input type="hidden" name="id" value="<?= $record["memberID"] ?>">
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>
    <script>
        const admin = <?= $record["is_admin"] ?>;
        if (admin === 0) {
            document.getElementById("admin").textContent = "一般";
        } else if (admin === 1) {
            document.getElementById("admin").textContent = "支援者";
        } else if (admin === 2) {
            document.getElementById("admin").textContent = "管理者";
        }
        // console.log(admin);
        const isdelete = <?= $record["is_dalete"] ?>;
        if (isdelete === 0) {
            document.getElementById("delete").textContent = "利用中";
        } else if (isdelete === 1) {
            document.getElementById("delete").textContent = "利用停止";
        }
    </script>
</body>

</html>