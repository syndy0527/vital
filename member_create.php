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
$dbn = 'mysql:dbname=sotusei_07;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

$sql = 'INSERT INTO member_table(memberID,mbname,seibetu,barthday,mbaddress)VALUES(NULL,:mbname,:seibetu,:barthday,:mbaddress)';

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
