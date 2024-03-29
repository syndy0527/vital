<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['sienkubun']) || $_POST['sienkubun'] == '' ||
    !isset($_POST['belongs']) || $_POST['belongs'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('Paramerror');
}

$sienkubun = $_POST['sienkubun'];
$belongs = $_POST['belongs'];
$id = $_POST['id'];
// var_dump($id);
// exit();

// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();
$sql = 'SELECT*FROM supporter_table WHERE member_id=:id';
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
    $sql = 'INSERT INTO supporter_table(id,member_id,support_id,belongs_id,created_at,update_at)VALUES(NULL,:id,:sienkubun ,:belongs,now(), now())';
} else {
    $sql
        = 'UPDATE supporter_table SET  support_id=:sienkubun, belongs_id=:belongs,update_at=now() WHERE member_id=:id';
}


$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':sienkubun', $sienkubun, PDO::PARAM_STR);
$stmt->bindValue(':belongs', $belongs, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header('Location:sien_base.php');
exit();
