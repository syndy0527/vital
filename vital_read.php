<?php
include('functions.php');
session_start();
check_session_id();

$memberid = $_SESSION['member_id'];
// DB接続
$pdo = connect_to_db();

$sql = 'SELECT * FROM vital_table WHERE member_id=:memberid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':memberid', $memberid, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($val);
// exit();
// echo '<pre>';

$output = "";
foreach ($val as $record) {
    $fukuyaku = "";
    if ($record['fukuyaku'] == 1) {
        $fukuyaku .= "飲んだ";
    } else if ($record['fukuyaku'] == 2) {
        $fukuyaku .= "飲んでない";
    };
    $output .= "<tr><td>{$record['record_date']}</td><td>{$record['taion']}℃</td><td>{$record['ketuatu_up']}/{$record['ketuatu_down']}</td><td>{$record['myakuhaku']}</td><td>{$record['wight']}</td><td>{$record['suibun']}</td><td>{$fukuyaku}</td></tr>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>健康情報一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_member_page.css">
</head>

<body>
    <nav class="navbar navbar-light bg-danger bg-opacity-25">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                <form class="d-flex fs-4">
                    <span class="navbar-text h5 ">
                        利用者:<?= $_SESSION['mbname'] ?>
                    </span>
                    <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center  g-2">
            <p class="h2 text-center my-5">健康情報一覧</p>
            <div class="table-responsive">
                <table class="table table-secondary table-hover mx-auto fs-5" style="max-width: 1000px;">
                    <thead>
                        <tr>
                            <th scope="col">登録日</th>
                            <th scope="col">体温</th>
                            <th scope="col">血圧</th>
                            <th scope="col">脈拍</th>
                            <th scope="col">体重</th>
                            <th scope="col">水分量</th>
                            <th scope="col">服薬状況</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $output ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center my-5">
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="vital_check.php" role="button">健康チェックへ</a>
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="vital.php" role="button">健康情報登録へ</a>
            </div>
        </div>
    </div>
</body>

</html>