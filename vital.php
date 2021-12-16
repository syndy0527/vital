<?php
// DB接続
// 各種項目設定
$dbn = 'mysql:dbname=sotusei_07;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

$sql = 'SELECT * FROM member_table';

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$member = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($member);
exit();

foreach ($member as $member_key) {
    $member .=
        "<option value='" . $member_key['memberID'];
    $member .= "'>" . $member_key['mbname'] . "</option>";
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
    <form action="vital_create.php" method="POST">
        <fieldset>
            <legend>バイタルデータ入力</legend>
            <div>
                会員番号：<select name="member_id">
                    <?php echo $member_key; ?>
                </select>
            </div>
            <div>
                記録日：<input type="date" name="record_date">
            </div>
            <div>
                体温：<input type="number" step="0.1" name="taion">
            </div>
            <div>
                血圧：<input type="number" name="ketuatu_up"> / <input type="number" name="ketuatu_down">
            </div>

            <button>submit</button>
        </fieldset>
    </form>

</body>

</html>