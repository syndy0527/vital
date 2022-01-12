<?php
include("functions.php");
session_start();
check_session_id();

$id = $_SESSION['memberID'];
$pdo = connect_to_db();
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
    <form action="member_create.php" method="POST">
        <fieldset>
            <legend>基本情報登録・変更</legend>
            <div>
                <P>氏名：<?= $_SESSION['mbname'] ?></P>
            </div>
            <div>
                性別：<select name="seibetu">
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
                <p> 登録状況：<?= $record["seibetu"] ?></p>
            </div>
            <div>
                生年月日：<input type="date" name="barthday">
                <p> 登録状況：<?= $record["barthday"] ?></p>
            </div>
            <div>
                住所：<input type="text" name="address">
                <p> 登録状況：<?= $record["mbaddress"] ?></p>
            </div>
            <div>
                <button>submit</button>
            </div>
            </div>
            <input type="hidden" name="id" value="<?= $_SESSION['memberID']  ?>">
            <div>
                <a href="member_home.php"> ホーム画面へ</a>
        </fieldset>


    </form>

</body>

</html>