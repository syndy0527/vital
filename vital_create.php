<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['id']) || $_POST['id'] == '' ||
    !isset($_POST['record_date']) || $_POST['record_date'] == '' ||
    !isset($_POST['taion']) || $_POST['taion'] == '' ||
    !isset($_POST['ketuatu_up']) || $_POST['ketuatu_up'] == '' ||
    !isset($_POST['ketuatu_down']) || $_POST['ketuatu_down'] == '' ||
    !isset($_POST['myakuhaku']) || $_POST['myakuhaku'] == '' ||
    !isset($_POST['wight']) || $_POST['wight'] == '' ||
    !isset($_POST['suibun']) || $_POST['suibun'] == '' ||
    !isset($_POST['fukuyaku']) || $_POST['fukuyaku'] == ''
) {
    exit('Paramerror');
}

$member_id = $_POST['id'];
$record_date = $_POST['record_date'];
$taion = $_POST['taion'];
$ketuatu_up = $_POST['ketuatu_up'];
$ketuatu_down = $_POST['ketuatu_down'];
$myakuhaku = $_POST['myakuhaku'];
$wight = $_POST['wight'];
$suibun = $_POST['suibun'];
$fukuyaku = $_POST['fukuyaku'];
// 各種項目設定
include('functions.php');
session_start();
check_session_id();
// DB接続
$pdo = connect_to_db();


$sql = 'INSERT INTO vital_table(id,member_id,record_date,taion,ketuatu_up,ketuatu_down,myakuhaku,wight,suibun,fukuyaku)VALUES(NULL,:member_id,:record_date,:taion,:ketuatu_up,:ketuatu_down,:myakuhaku,:wight,:suibun,:fukuyaku)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':member_id', $member_id, PDO::PARAM_STR);
$stmt->bindValue(':record_date', $record_date, PDO::PARAM_STR);
$stmt->bindValue(':taion', $taion, PDO::PARAM_STR);
$stmt->bindValue(':ketuatu_up', $ketuatu_up, PDO::PARAM_STR);
$stmt->bindValue(':ketuatu_down', $ketuatu_down, PDO::PARAM_STR);
$stmt->bindValue(':myakuhaku', $myakuhaku, PDO::PARAM_STR);
$stmt->bindValue(':wight', $wight, PDO::PARAM_STR);
$stmt->bindValue(':suibun', $suibun, PDO::PARAM_STR);
$stmt->bindValue(':fukuyaku', $fukuyaku, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:vital.php');
exit();
