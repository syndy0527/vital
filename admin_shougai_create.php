<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

if (
    !isset($_POST['shougai']) || $_POST['shougai'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('Paramerror');
}

$shougai = $_POST['shougai'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = 'INSERT INTO shougai_table(id,shougai_id,shougai)VALUES(NULL,:id,:shougai)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':shougai', $shougai, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:admin_shougai_read.php');
exit();
