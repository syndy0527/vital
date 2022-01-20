<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
$pdo = connect_to_db();

$sql = "SELECT * FROM kaigonintei_table ORDER BY kaigonintei_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$kaigo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($kaigo as $record) {
    // var_dump($record["kaigonintei"]);
    // exit();
    $output .= "<option value='{$record['kaigonintei_id']}'>{$record['kaigonintei']}</option>";
};
$sql = "SELECT * FROM shougai_table ORDER BY shougai_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$shougai = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output1 = "";
foreach ($shougai as $val) {
    // var_dump($record["kaigonintei"]);
    // exit();
    $output1 .= "<option value='{$val['shougai_id']}'>{$val['shougai']}</option>";
};
$sql = 'SELECT result1_table.member_id,result1_table.mbname,result1_table.support_id,result1_table.support, result1_table.belongs_id,belongs_table.belongs FROM(SELECT result_table.member_id,result_table.mbname,result_table.support_id,support_table.support, result_table.belongs_id FROM(SELECT member_table.member_id,mbname,support_id,belongs_id FROM `member_table` LEFT OUTER JOIN supporter_table ON member_table.member_id=supporter_table.member_id WHERE support_id=3) AS result_table LEFT OUTER JOIN support_table ON result_table.support_id=support_table.support_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id ';
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
$output2 = "";
foreach ($result as $record2) {
    // var_dump($record2["support"]);
    // exit();
    $output2 .= "<option value='{$record2['member_id']}'>{$record2['belongs']} / {$record2['mbname']}</option>";
}
$sql = 'SELECT result1_table.member_id,result1_table.mbname,result1_table.support_id,result1_table.support, result1_table.belongs_id,belongs_table.belongs FROM(SELECT result_table.member_id,result_table.mbname,result_table.support_id,support_table.support, result_table.belongs_id FROM(SELECT member_table.member_id,mbname,support_id,belongs_id FROM `member_table` LEFT OUTER JOIN supporter_table ON member_table.member_id=supporter_table.member_id WHERE support_id=4) AS result_table LEFT OUTER JOIN support_table ON result_table.support_id=support_table.support_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id ';
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
$output3 = "";
foreach ($result1 as $record3) {
    // var_dump($record2["support"]);
    // exit();
    $output3 .= "<option value='{$record3['member_id']}'>{$record3['belongs']} / {$record3['mbname']}</option>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="member_medical_update.php" method="POST">
        <fieldset>
            <legend>医療情報登録</legend>
            <a href="member_input.php">基本情報入力</a>
            <div>
                利用者：<?= $_SESSION['mbname'] ?>
            </div>
            <div>
                介護認定: <select name="kaigonintei" id="">
                    <?= $output ?>
                </select>
            </div>
            <div>
                障がい認定: <select name="shougai" id="">
                    <?= $output1 ?>
                </select>
            </div>
            <div>
                ケアマネジャー: <select name="caremane" id="">
                    <?= $output2 ?>
                </select>
            </div>
            <div>
                かかりつけ医師: <select name="pcd" id="">
                    <?= $output3 ?>
                </select>
            </div>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">
            <div>
                <button>submit</button>
            </div>

</body>

</html>