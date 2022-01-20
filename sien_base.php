<?php
include("functions.php");
session_start();
check_session_id();

$id = $_SESSION['member_id'];
// var_dump($id);
// exit();
$pdo = connect_to_db();
$sql = 'SELECT * FROM member_table WHERE is_admin=1';

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$member = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($record);
// echo '<pre>';
// exit();

$sql = "SELECT * FROM support_table ORDER BY support_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$support = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($support as $record) {
    //     // var_dump($record["kaigonintei"]);
    //     // exit();
    $output .= "<option value='{$record['support_id']}'>{$record['support']}</option>";
}
$sql = "SELECT * FROM belongs_table ORDER BY belongs_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$belongs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output1 = "";
foreach ($belongs as $record1) {
    // var_dump($record1["belongs"]);
    // exit();
    $output1 .= "<option value='{$record1['belongs_id']}'>{$record1['belongs']}</option>";
}
$sql = 'SELECT result1_table.member_id,result1_table.mbname,result1_table.support_id,result1_table.support, result1_table.belongs_id,belongs_table.belongs FROM(SELECT result_table.member_id,result_table.mbname,result_table.support_id,support_table.support, result_table.belongs_id FROM(SELECT member_table.member_id,mbname,support_id,belongs_id FROM `member_table` LEFT OUTER JOIN supporter_table ON member_table.member_id=supporter_table.member_id WHERE member_table.member_id=:id) AS result_table LEFT OUTER JOIN support_table ON result_table.support_id=support_table.support_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
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
$output2 = "";
foreach ($result as $record2) {
    // var_dump($record2["support"]);
    // exit();
    $output2 .= "<p> 登録状況：{$record2["support"]}</p>";
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
    <form action="sien_create.php" method="POST">
        <fieldset>
            <legend>支援者基本情報登録</legend>
            <div>
                <P>氏名：<?= $_SESSION['mbname'] ?></P>
            </div>
            <div>
                支援区分：<select name="sienkubun">
                    <?= $output ?>
                </select>
                <?= $output2  ?>
            </div>
            <div>
                所属：<select name="belongs">
                    <?= $output1  ?>
                </select>
                <p> 登録状況：<?= $record2["belongs"] ?></p>
            </div>
            <div>
                <button>submit</button>
            </div>
            </div>
            <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
            <div>
                <a href="sien_home.php"> ホーム画面へ</a>
        </fieldset>


    </form>
</body>

</html>