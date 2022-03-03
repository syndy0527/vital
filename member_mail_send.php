<?php
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();


if (
    !isset($_POST['recieve_id']) || $_POST['recieve_id'] == '' ||
    !isset($_POST['text']) || $_POST['text'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$recieve_id = $_POST['recieve_id'];
$text = $_POST['text'];
$id = $_POST['id'];

// var_dump($recieve_id);
// exit();

if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
    // 送信が正常に行われたときの処理
    // file_upload.php

    $uploaded_file_name = $_FILES['upfile']['name'];
    $temp_path  = $_FILES['upfile']['tmp_name'];
    $directory_path = 'upload/';

    // file_upload.php

    $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . '.' . $extension;
    $save_path = $directory_path . $unique_name;

    // var_dump($save_path);
    // exit();

    // file_upload.php

    if (is_uploaded_file($temp_path)) {
        if (move_uploaded_file($temp_path, $save_path)) {
            chmod($save_path, 0644);
            $img = '<img src="' . $save_path . '" >';
        } else {
            exit('Error:アップロードできませんでした');
        }
    } else {
        exit('Error:画像がありません');
    }
} else {
    $img = NULL;
}

$pdo = connect_to_db();

$sql = 'INSERT INTO communicate_table(id,send_member_id	, text,image,recieve_member_id, created_at) VALUES(NULL, :id, :text,:image, :recieve_id, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->bindValue(':image', $save_path, PDO::PARAM_STR);
$stmt->bindValue(':recieve_id', $recieve_id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// //メッセージリレーション
// $pdo = connect_to_db();
// $sql = 'SELECT send_member_id,recieve_member_id FROM message_relation_table WHERE (send_member_id=:id and recieve_member_id=:recieve_id) or (send_member_id=:recieve_id and recieve_member_id=:id) ORDER BY created_at ASC';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $stmt->bindValue(':recieve_id', $recieve_id, PDO::PARAM_INT);
// // SQL実行（実行に失敗すると `sql error ...` が出力される）
// try {
//     $status = $stmt->execute();
// } catch (PDOException $e) {
//     echo json_encode(["sql error" => "{$e->getMessage()}"]);
//     exit();
// }
// $m_relation = $stmt->fetch(PDO::FETCH_ASSOC);

// //メッセージリレーションテーブル登録
// if (!isset($m_relation)) {
//     $sql = 'INSERT INTO message_relation_table(id,send_member_id,recieve_member_id)VALUES(NULL,:id,:recieve_id)';
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':id', $id, PDO::PARAM_STR);
//     $stmt->bindValue(':recieve_id', $recieve_id, PDO::PARAM_STR);
//     try {
//         $status = $stmt->execute();
//     } catch (PDOException $e) {
//         echo json_encode(["sql error" => "{$e->getMessage()}"]);
//         exit();
//     }
// }

// header("Location:member_mail.php?id={$recieve_id}");
// exit();
