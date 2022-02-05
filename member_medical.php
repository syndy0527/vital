<?php
include('functions.php');
session_start();
check_session_id();
// データ接続
$id = $_SESSION['member_id'];
$pdo = connect_to_db();
// 介護認定ドロップダウン
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

// 障がい区分ドロップダウン
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

// ケアマネドロップダウン
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
// var_dump($result1);
// echo '<pre>';
// exit();
$output2 = "";
foreach ($result as $record2) {
    // var_dump($record2["support"]);
    // exit();
    $output2 .= "<option value='{$record2['member_id']}'>{$record2['belongs']} / {$record2['mbname']}</option>";
}

//かかりつけ医ドロップダウン
$sql = 'SELECT result1_table.member_id,result1_table.mbname,result1_table.support_id,result1_table.support, result1_table.belongs_id,belongs_table.belongs FROM(SELECT result_table.member_id,result_table.mbname,result_table.support_id,support_table.support, result_table.belongs_id FROM(SELECT member_table.member_id,mbname,support_id,belongs_id FROM `member_table` LEFT OUTER JOIN supporter_table ON member_table.member_id=supporter_table.member_id WHERE support_id=4) AS result_table LEFT OUTER JOIN support_table ON result_table.support_id=support_table.support_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id ';
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
$output4 = "";
foreach ($result2 as $record4) {
    // var_dump($record2["support"]);
    // exit();
    $output4 .= "<option value='{$record4['member_id']}'>{$record4['belongs']} / {$record4['mbname']}</option>";
}

// 介護認定登録状況
$sql = "SELECT member_id,medical_table.kaigonintei_id,kaigonintei FROM `medical_table` LEFT OUTER JOIN kaigonintei_table ON medical_table.kaigonintei_id=kaigonintei_table.kaigonintei_id WHERE member_id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$kaigo1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($kaigo1['kaigonintei']) || $kaigo1['kaigonintei'] == '' ||
    !isset($kaigo1['member_id']) || $kaigo1['member_id'] == '' ||
    !isset($kaigo1['kaigonintei_id']) || $kaigo1['kaigonintei_id'] == ''
) {
    $kaigo1['kaigonintei'] = NULL;
    $kaigo1['member_id'] = NULL;
    $kaigo1['kaigonintei_id'] = NULL;
}
// var_dump($kaigo1["member_id"]);
// exit();

// 障がい区分登録状況
$sql = "SELECT member_id,medical_table.shougainintei_id,shougai FROM `medical_table` LEFT OUTER JOIN shougai_table ON medical_table.shougainintei_id=shougai_table.shougai_id WHERE member_id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$shougai1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($shougai1['shougai']) || $shougai1['shougai'] == '' ||
    !isset($shougai1['member_id']) || $shougai1['member_id'] == '' ||
    !isset($shougai1['shougainintei_id']) || $shougai1['shougainintei_id'] == ''
) {
    $shougai1['shougai'] = NULL;
    $shougai1['member_id'] = NULL;
    $shougai1['shougainintei_id'] = NULL;
}
// var_dump($shougai1["member_id"]);
// exit();

// ケアマネ登録状況
$sql = "SELECT  result1_table.member_id,result1_table.mbname,belongs FROM (SELECT result_table.member_id,result_table.mbname,belongs_id FROM (SELECT medical_table.member_id,medical_table.caremane,caredocter,mbname FROM `medical_table` LEFT OUTER JOIN member_table ON medical_table.caremane=member_table.member_id) AS result_table LEFT OUTER JOIN supporter_table ON result_table.caremane=supporter_table.member_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id WHERE member_id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($result1['mbname']) || $result1['mbname'] == '' ||
    !isset($result1['member_id']) || $result1['member_id'] == '' ||
    !isset($result1['belongs']) || $result1['belongs'] == ''
) {
    $result1['mbname'] = NULL;
    $result1['member_id'] = NULL;
    $result1['belongs'] = NULL;
}
// echo '<pre>';
// var_dump($result1['member_id']);
// echo '<pre>';
// exit();
$output3 = "<p> 登録状況：{$result1['belongs']} / {$result1['mbname']}</p>";

// ケアマネ登録状況
$sql = "SELECT  result1_table.member_id,result1_table.mbname,belongs FROM (SELECT result_table.member_id,result_table.mbname,belongs_id FROM (SELECT medical_table.member_id,medical_table.caremane,caredocter,mbname FROM `medical_table` LEFT OUTER JOIN member_table ON medical_table.caredocter=member_table.member_id) AS result_table LEFT OUTER JOIN supporter_table ON result_table.caredocter=supporter_table.member_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id WHERE member_id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result3 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($result3['mbname']) || $result3['mbname'] == '' ||
    !isset($result3['member_id']) || $result3['member_id'] == '' ||
    !isset($result3['belongs']) || $result3['belongs'] == ''
) {
    $result3['mbname'] = NULL;
    $result3['member_id'] = NULL;
    $result3['belongs'] = NULL;
}
$output5 = "<p> 登録状況：{$result3['belongs']} / {$result3['mbname']}</p>";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
    </header>
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
                <p> 登録状況：<?= $kaigo1["kaigonintei"] ?></p>
            </div>
            <div>
                障がい認定: <select name="shougai" id="">
                    <?= $output1 ?>
                </select>
                <p> 登録状況：<?= $shougai1["shougai"] ?></p>
            </div>
            <div>
                ケアマネジャー: <select name="caremane" id="">
                    <?= $output2 ?>
                </select>
                <?= $output3 ?>
            </div>
            <div>
                かかりつけ医師: <select name="pcd" id="">
                    <?= $output4 ?>
                </select>
                <?= $output5 ?>
            </div>
            </div>

            <input type="hidden" name="id" value="<?= $_SESSION['member_id'] ?>">
            <div>
                <button>submit</button>
            </div>
        </fieldset>
        <div class="top">
            <a class="gohome" href=" member_input.php"><span>基本情報入力へ</span></a>
        </div>

</body>

</html>