<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['member_id']) || $_POST['member_id'] == '' ||
    !isset($_POST['record_date']) || $_POST['record_date'] == '' ||
    !isset($_POST['taion']) || $_POST['taion'] == '' ||
    !isset($_POST['ketuatu_up']) || $_POST['ketuatu_up'] == '' ||
    !isset($_POST['ketuatu_down']) || $_POST['ketuatu_down'] == ''
) {
    exit('Paramerror');
}

$member_id = $_POST['member_id'];
$record_date = $_POST['record_date'];
$taion = $_POST['taion'];
$ketuatu_up = $_POST['ketuatu_up'];
$ketuatu_down = $_POST['ketuatu_down'];
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

$sql = 'INSERT INTO vital_table(id,member_id,record_date,taion,ketuatu_up,ketuatu_down)VALUES(NULL,:member_id,:record_date,:taion,:ketuatu_up,:ketuatu_down)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':member_id', $member_id, PDO::PARAM_STR);
$stmt->bindValue(':record_date', $record_date, PDO::PARAM_STR);
$stmt->bindValue(':taion', $taion, PDO::PARAM_STR);
$stmt->bindValue(':ketuatu_up', $ketuatu_up, PDO::PARAM_STR);
$stmt->bindValue(':ketuatu_down', $ketuatu_down, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:vital.php');
exit();
