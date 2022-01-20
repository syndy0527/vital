<?php
// var_dump($_GET);
// exit();
// データ受け取り
$id = $_GET['id'];
// DB接続
include('functions.php');
session_start();
check_session_id();
$pdo = connect_to_db();
// SQL実行
$sql = 'DELETE FROM member_table WHERE member_id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
header("Location:member_read.php");
exit();
