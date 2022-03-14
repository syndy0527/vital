<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['shougai']) || $_POST['shougai'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$shougai = $_POST['shougai'];
$id = $_POST['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE shougai_table SET  shougai=:shougai WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':shougai', $shougai, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:admin_shougai_read.php");
exit();
