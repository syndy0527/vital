<?php
// var_dump($_POST);
// exit();
if (
    !isset($_POST['mbname']) || $_POST['mbname'] == '' ||
    !isset($_POST['logid']) || $_POST['logid'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    exit('paramError');
}

$mbname = $_POST["mbname"];
$logid = $_POST["logid"];
$password = $_POST["password"];
$password_after = password_hash($password, PASSWORD_DEFAULT);
// var_dump($password_after);
// exit();

include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT count(*) FROM member_table WHERE login_id=:logid';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':logid', $logid, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    echo '<p>すでに登録されているユーザIDです．</p>';
    echo '<a href="login.php">login</a>';
    exit();
} else {


    $sql = 'INSERT INTO member_table(member_id,mbname,login_id,password,is_admin,is_dalete,seibetu,barthday,mbaddress,created_at,update_at)VALUES(NULL,:mbname ,:logid, :password,0, 0,0,0,0, now(), now())';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mbname', $mbname, PDO::PARAM_STR);
    $stmt->bindValue(':logid', $logid, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password_after, PDO::PARAM_STR);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    header("Location:login.php");
    exit();
};
