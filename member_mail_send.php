<?php
// var_dump($_FILES);
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
    exit('Error:画像が送信されていません');
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

header("Location:member_mail.php");
exit();
