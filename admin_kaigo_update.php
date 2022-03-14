<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['kaigonintei']) || $_POST['kaigonintei'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$kaigonintei = $_POST['kaigonintei'];
$id = $_POST['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE kaigonintei_table SET  kaigonintei=:kaigonintei WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':kaigonintei', $kaigonintei, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:admin_kaigo_read.php");
exit();
