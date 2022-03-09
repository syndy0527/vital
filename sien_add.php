<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();
if (
    !isset($_POST['sien']) || $_POST['sien'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('追加する人を選んでください');
}

$sien = $_POST["sien"];
$sien_id = $_POST["id"];
// var_dump($friend_id);
// exit();

include('functions.php');
session_start();
check_session_id();

$id = $_SESSION['member_id'];

$pdo = connect_to_db();
// 登録あるかを検索
$sql = 'SELECT*FROM sien_table WHERE member_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();
if (isset($val)) {
    // echo '<pre>';
    // var_dump($val);
    // echo '<pre>';
    // exit();
    foreach ($val as $record) {
        // var_dump($record);
        // exit();
        if ($record["sien_id"] == $sien_id) {
            exit('すでに支援対象者になっています。');
            // var_dump($record["friend_id"]);
            // exit();


        }
    }
    $sql = 'INSERT INTO sien_table(id,member_id,sien_id,sien_check)VALUES(NULL,:id,:sien_id ,:sien_check)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_STR);
    $stmt->bindValue(':sien_check', $sien, PDO::PARAM_STR);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
} else {
    $sql = 'INSERT INTO sien_table(id,member_id,sien_id,sien_check)VALUES(NULL,:id,:sien_id ,:sien_check)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_STR);
    $stmt->bindValue(':sien_check', $sien, PDO::PARAM_STR);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}
header("Location:sien_select.php");
exit();
