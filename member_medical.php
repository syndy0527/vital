<?php
include('functions.php');
session_start();
check_session_id();
$memberid = $_SESSION['member_id'];
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
                ケアマネジャー: <input type="text" name="caremane">
            </div>
            <div>
                かかりつけ医師: <input type="text" name="caredoc">
            </div>
            </div>

            <input type="hidden" name="id" value="<?= $memberid ?>">
            <div>
                <button>submit</button>
            </div>

</body>

</html>