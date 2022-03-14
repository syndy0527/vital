<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

if (
    !isset($_POST['kaigonintei']) || $_POST['kaigonintei'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('Paramerror');
}

$kaigonintei = $_POST['kaigonintei'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = 'INSERT INTO kaigonintei_table(id,kaigonintei_id,kaigonintei)VALUES(NULL,:id,:kaigonintei)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':kaigonintei', $kaigonintei, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:admin_kaigo_read.php');
exit();
