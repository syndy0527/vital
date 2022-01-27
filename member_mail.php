<?php
include('functions.php');
session_start();
check_session_id();
// DB接続
$pdo = connect_to_db();


$sql = "SELECT friend_table.friend_id,mbname FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id;";

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
    $output .= "<option value='{$record['friend_id']}'>{$record['mbname']}</option>";
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
    <form action="member_mail_send.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>メール送信</legend>
            <a href="member_kaiwa.php">友達の話すホームへ</a>
            <div>
                利用者：<?= $_SESSION['mbname'] ?>
            </div>
            <div>
                相手先：<select name="recieve_id" id="">
                    <?= $output ?>
                </select>
            </div>
            <div>
                コメント：<textarea name="text" id="" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="file" name="upfile" accept="image/*" capture="camera" />
            </div>
            <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
            <div>
                <button>submit</button>
            </div>

        </fieldset>
    </form>

</body>

</html>