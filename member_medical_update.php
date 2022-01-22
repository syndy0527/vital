<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['kaigonintei']) || $_POST['kaigonintei'] == '' ||
    !isset($_POST['shougai']) || $_POST['shougai'] == '' ||
    !isset($_POST['caremane']) || $_POST['caremane'] == '' ||
    !isset($_POST['pcd']) || $_POST['pcd'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('Paramerror');
}

$kaigonintei = $_POST['kaigonintei'];
$shougai = $_POST['shougai'];
$caremane = $_POST['caremane'];
$pcd = $_POST['pcd'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();
$sql = 'SELECT*FROM medical_table WHERE member_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val["member_id"]);
// exit();

if ($val["member_id"] == NULL) {
    $sql = 'INSERT INTO medical_table(id,member_id,kaigonintei_id,shougainintei_id,caremane,caredocter,created_at,update_at)VALUES(NULL,:id,:kaigonintei ,:shougai,:caremane,:pcd,now(), now())';
} else {
    $sql
        = 'UPDATE medical_table SET  kaigonintei_id=:kaigonintei, shougainintei_id=:shougai,caremane=:caremane,caredocter=:pcd,update_at=now() WHERE member_id=:id';
}


$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':kaigonintei', $kaigonintei, PDO::PARAM_STR);
$stmt->bindValue(':shougai', $shougai, PDO::PARAM_STR);
$stmt->bindValue(':caremane', $caremane, PDO::PARAM_STR);
$stmt->bindValue(':pcd', $pcd, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:member_medical.php');
exit();
