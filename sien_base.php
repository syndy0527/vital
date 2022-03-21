<?php
include("functions.php");
session_start();
check_session_id();

$id = $_SESSION['member_id'];
// var_dump($id);
// exit();
$pdo = connect_to_db();
$sql = 'SELECT * FROM member_table WHERE is_admin=1';

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$member = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($record);
// echo '<pre>';
// exit();

$sql = "SELECT * FROM support_table ORDER BY support_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$support = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($support as $record) {
    //     // var_dump($record["kaigonintei"]);
    //     // exit();
    $output .= "<option value='{$record['support_id']}'>{$record['support']}</option>";
}
$sql = "SELECT * FROM belongs_table ORDER BY belongs_id ASC";
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$belongs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output1 = "";
foreach ($belongs as $record1) {
    // var_dump($record1["belongs"]);
    // exit();
    $output1 .= "<option value='{$record1['belongs_id']}'>{$record1['belongs']}</option>";
}
$sql = 'SELECT result1_table.member_id,result1_table.mbname,result1_table.support_id,result1_table.support, result1_table.belongs_id,belongs_table.belongs FROM(SELECT result_table.member_id,result_table.mbname,result_table.support_id,support_table.support, result_table.belongs_id FROM(SELECT member_table.member_id,mbname,support_id,belongs_id FROM `member_table` LEFT OUTER JOIN supporter_table ON member_table.member_id=supporter_table.member_id WHERE member_table.member_id=:id) AS result_table LEFT OUTER JOIN support_table ON result_table.support_id=support_table.support_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
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
    $output2 .= "{$record2["support"]}";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支援者基本情報登録・変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home_sien.css">
</head>

<body>
    <nav class="navbar navbar-light bg-primary bg-opacity-25">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                <form class="d-flex fs-4">
                    <span class="navbar-text h5 ">
                        支援者:<?= $_SESSION['mbname'] ?>
                    </span>
                    <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                </form>
        </div>
    </nav>
    <form action="sien_create.php" method="POST">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-primary bg-opacity-25">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="img/comictlogo.png" alt="" width="250" height="60" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-dark fw-bold fs-4" href="#">支援者:<?= $_SESSION['mbname'] ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary text-white fs-5 " href="logout.php" role="button">ログアウト</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="mb-5">
            <div class="container-fluid">
                <div class="row justify-content-center  g-2">
                    <p class="h2 text-center my-5">支援者基本情報登録・変更</p>
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">支援区分</span>
                        <select class="form-select fs-5" name="sienkubun" id="">
                            <?= $output ?>
                        </select>
                        <form>
                            <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                    <input type="text" class="form-control fs-5 " placeholder="<?= $output2 ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">所属</span>
                        <select class="form-select fs-5" name="belongs" id="">
                            <?= $output1 ?>
                        </select>
                        <form>
                            <fieldset disabled class="input-group justify-content-center" style="max-width: 450px;">
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                    <input type="text" class="form-control fs-5 " placeholder="<?= $record2["belongs"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col text-center mb-5">
                            <button class="btn btn-outline-success btn-lg fs-5" style="width: 200px;;height:50px">登 録</button>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="id" value="<?= $_SESSION['member_id'] ?>">
                </div>
            </div>
            </div>
    </form>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center my-5">
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="sien_home.php" role="button">支援者ホームへ</a>
            </div>
        </div>
    </div>
    </main>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>