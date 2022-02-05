<?php
// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();
if (
    !isset($_POST['friend']) || $_POST['friend'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    exit('追加する人を選んでください');
}

$friend = $_POST["friend"];
$friend_id = $_POST["id"];
// var_dump($friend_id);
// exit();

include('functions.php');
session_start();
check_session_id();

$id = $_SESSION['member_id'];

$pdo = connect_to_db();
// 登録あるかを検索
$sql = 'SELECT*FROM friend_table WHERE member_id=:id';
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
if ($val != NULL) {
    foreach ($val as $record) {
        // var_dump($friend_id);
        // exit();
        if ($record["friend_id"] != $friend_id || $record["friend_id"] == NULL) {
            $sql = 'INSERT INTO friend_table(id,member_id,friend_id,friend_check)VALUES(NULL,:id,:friend_id ,:friend_check)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_STR);
            $stmt->bindValue(':friend_check', $friend, PDO::PARAM_STR);
            try {
                $status = $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(["sql error" => "{$e->getMessage()}"]);
                exit();
            }
        } else {
            exit('すでに友達になっています。');
        }
    }
} else {
    $sql = 'INSERT INTO friend_table(id,member_id,friend_id,friend_check)VALUES(NULL,:id,:friend_id ,:friend_check)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_STR);
    $stmt->bindValue(':friend_check', $friend, PDO::PARAM_STR);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}
header("Location:member_friend_add.html");
exit();
