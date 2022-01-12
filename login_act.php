<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');

$logid = $_POST['logid'];
$password = $_POST['password'];

$pdo = connect_to_db();

// username，password，is_deletedの3項目全てを満たすデータを抽出する．
$sql = 'SELECT * FROM member_table WHERE loginID=:logid AND password=:password AND is_dalete=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':logid', $logid, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$val) {
    echo "<p>ログイン情報に誤りがあります</p>";
    echo "<a href=login.php>ログイン</a>";
    exit();
} else {
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['is_admin'] = $val['is_admin'];
    $_SESSION['mbname'] = $val['mbname'];
    $_SESSION['memberID'] = $val['memberID'];

    if ($val['is_admin'] == 1) {
        header("Location:sien_home.php");
        exit();
    } else if ($val['is_admin'] == 0) {
        header("Location:member_home.php");
        exit();
    } else if ($val['is_admin'] == 2) {
        header("Location:admin_home.php");
        exit();
    }
}
