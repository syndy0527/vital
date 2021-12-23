<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

if (
    !isset($_POST['mbname']) || $_POST['mbname'] == '' ||
    !isset($_POST['seibetu']) || $_POST['seibetu'] == '' ||
    !isset($_POST['barthday']) || $_POST['barthday'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == ''
) {
    exit('Paramerror');
}

$mbname = $_POST['mbname'];
$seibetu = $_POST['seibetu'];
$barthday = $_POST['barthday'];
$address = $_POST['address'];

// 各種項目設定
include('functions.php');

// DB接続
$pdo = connect_to_db();


$sql = 'INSERT INTO member_table(memberID,mbname,seibetu,barthday,mbaddress,created_at,update_at)VALUES(NULL,:mbname,:seibetu,:barthday,:mbaddress,NOW(),NOW())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':mbname', $mbname, PDO::PARAM_STR);
$stmt->bindValue(':seibetu', $seibetu, PDO::PARAM_STR);
$stmt->bindValue(':barthday', $barthday, PDO::PARAM_STR);
$stmt->bindValue(':mbaddress', $address, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:member.php');
exit();
