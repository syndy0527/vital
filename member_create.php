<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

if (
    !isset($_POST['seibetu']) || $_POST['seibetu'] == '' ||
    !isset($_POST['barthday']) || $_POST['barthday'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('Paramerror');
}

$seibetu = $_POST['seibetu'];
$barthday = $_POST['barthday'];
$address = $_POST['address'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = 'UPDATE member_table SET member_id=:id,seibetu=:seibetu,barthday=:barthday,mbaddress=:mbaddress,update_at=NOW() WHERE member_id=:id';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':seibetu', $seibetu, PDO::PARAM_STR);
$stmt->bindValue(':barthday', $barthday, PDO::PARAM_STR);
$stmt->bindValue(':mbaddress', $address, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:member.php');
exit();
