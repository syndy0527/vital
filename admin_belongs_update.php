<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['belongs']) || $_POST['belongs'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('paramError');
}

$belongs = $_POST['belongs'];
$id = $_POST['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE belongs_table SET  belongs=:belongs WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':belongs', $belongs, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:admin_belongs_read.php");
exit();
