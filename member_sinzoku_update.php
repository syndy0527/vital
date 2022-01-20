<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['sinzokuname']) || $_POST['sinzokuname'] == '' ||
    !isset($_POST['sinzokuadd']) || $_POST['sinzokuadd'] == '' ||
    !isset($_POST['sinzokugara']) || $_POST['sinzokugara'] == '' ||
    !isset($_POST['sinzokutel']) || $_POST['sinzokutel'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$name = $_POST['sinzokuname'];
$add = $_POST['sinzokuadd'];
$zokugara = $_POST['sinzokugara'];
$tel = $_POST['sinzokutel'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// DB接続
include('functions.php');
session_start();
check_session_id();

$pdo = connect_to_db();
$sql = 'INSERT INTO sinzoku_table(id,member_id,sinzokuname,sinzokuadd,sinzokugara,sinzokutel,created_at,update_at)VALUES(NULL,:id,:name ,:add, :zokugara,:tel, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':add', $add, PDO::PARAM_STR);
$stmt->bindValue(':zokugara', $zokugara, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:member_sinzoku.php");
exit();
