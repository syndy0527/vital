<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['support']) || $_POST['support'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$support = $_POST['support'];
$id = $_POST['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE support_table SET  support=:support WHERE support_id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':support', $support, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:admin_supporttable_read.php");
exit();
