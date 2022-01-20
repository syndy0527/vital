<?php
include('functions.php');
session_start();
check_session_id();

$memberid = $_SESSION['member_id'];
// DB接続
$pdo = connect_to_db();

$sql = 'SELECT * FROM vital_table WHERE member_id=:memberid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':memberid', $memberid, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($val);
// exit();
// echo '<pre>';

$output = "";
foreach ($val as $record) {
    $fukuyaku = "";
    if ($record['fukuyaku'] == 1) {
        $fukuyaku .= "飲んだ";
    } else if ($record['fukuyaku'] == 2) {
        $fukuyaku .= "飲んでない";
    };
    $output .= "<tr><td>{$record['record_date']}</td><td>{$record['taion']}℃</td><td>{$record['ketuatu_up']}/{$record['ketuatu_down']}</td><td>{$record['myakuhaku']}</td><td>{$record['wight']}</td><td>{$record['suibun']}</td><td>{$fukuyaku}</td></tr>";
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
        <legend>健康情報</legend>
        <a href="vital_check.php">健康チェックへ</a>
        <div>
            利用者：<?= $_SESSION['mbname'] ?>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>登録日</th>
                    <th>体温</th>
                    <th>血圧</th>
                    <th>脈拍</th>
                    <th>体重</th>
                    <th>水分量</th>
                    <th>服薬状況</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset>

</body>

</html>