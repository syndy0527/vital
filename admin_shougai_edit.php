<?php
// var_dump($_GET);
// exit();
// id受け取り

$id = $_GET["id"];
// DB接続
include('functions.php');
session_start();
check_session_id();
$pdo = connect_to_db();
// SQL実行
$sql = 'SELECT * FROM shougai_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>障がい区分変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home_admin.css">
</head>

<body>
    <nav class="navbar navbar-light bg-success bg-opacity-25">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                <form class="d-flex fs-4">
                    <span class="navbar-text h5 ">
                        管理者:<?= $_SESSION['mbname'] ?>
                    </span>
                    <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                </form>
        </div>
    </nav>
    <form action="admin_shougai_update.php" method="POST">
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">障がい区分変更</p>
                <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                    <form>
                        <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">ID</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["shougai_id"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center  g-2">
                <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">障がい区分</span>
                    <input type="text" name="shougai" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <form>
                        <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["shougai"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                <input type="hidden" name="id" value="<?= $record["id"] ?>">
            </div>
        </div>
    </form>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center my-5">
                <a class="btn btn-secondary btn-lg fs-5" style="width: 250px;;height:50px" href="admin_shougai_read.php" role="button">支援者区分変更・追加へ</a>
            </div>
        </div>
    </div>
</body>

</html>