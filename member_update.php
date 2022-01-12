<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['mbaddress']) || $_POST['mbaddress'] == '' ||
    !isset($_POST['admin']) || $_POST['admin'] == '' ||
    !isset($_POST['delete']) || $_POST['delete'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$add = $_POST['mbaddress'];
$admin = $_POST['admin'];
$delete = $_POST['delete'];
$id = $_POST['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE member_table SET  mbaddress=:mbadd, memberID=:id,is_admin=:admin,is_dalete=:delete,update_at=now() WHERE memberID=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mbadd', $add, PDO::PARAM_STR);
$stmt->bindValue(':admin', $admin, PDO::PARAM_STR);
$stmt->bindValue(':delete', $delete, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:member_read.php");
exit();
