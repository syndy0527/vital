<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');

$logid = $_POST['logid'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$new_password_after = password_hash($new_password, PASSWORD_DEFAULT);

$pdo = connect_to_db();

// username，password，is_deletedの3項目全てを満たすデータを抽出する．
$sql = 'SELECT * FROM member_table WHERE login_id=:logid AND is_dalete=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':logid', $logid, PDO::PARAM_STR);
// $stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

if ($logid == $val['login_id']) {
    if (password_verify($old_password, $val['password'])) {
        $pdo = connect_to_db();
        $sql = 'UPDATE member_table SET password=:new_password_after,update_at=NOW() WHERE login_id=:logid';
        $stmt = $pdo->prepare($sql);
        // バインド変数を設定
        $stmt->bindValue(':new_password_after', $new_password_after, PDO::PARAM_STR);
        $stmt->bindValue(':logid', $logid, PDO::PARAM_STR);
        // SQL実行（実行に失敗すると `sql error ...` が出力される）
        try {
            $status = $stmt->execute();
        } catch (PDOException $e) {
            echo json_encode(["sql error" => "{$e->getMessage()}"]);
            exit();
        }
        header('Location:member.php');
        exit();
    } else {
        echo "<p>パスワードが違います</p>";
        echo "<a href=password_reset.php>パスワード変更</a>";
    }
} else {
    echo "<p>ログインIDの登録がありません</p>";
    echo "<a href=password_reset.php>パスワード変更</a>";
}
