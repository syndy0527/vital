<?php
// var_dump($_POST);
// exit();
$search_word = $_GET["searchword"];

include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];

$pdo = connect_to_db();



$sql = "SELECT * FROM member_table  WHERE mbname LIKE :search_word AND is_admin=0 AND member_id!=$id";


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
// 省略

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
exit();
