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
$sql = 'SELECT * FROM belongs_table WHERE id=:id';

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
    <title>管理者変更</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home_admin.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-success bg-opacity-25">
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
                            <a class="nav-link text-dark fw-bold fs-4" href="#">管理者:<?= $_SESSION['mbname'] ?></a>
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
        <form action="admin_belongs_update.php" method="POST">
            <div class="container-fluid">
                <div class="row justify-content-center  g-2">
                    <p class="h2 text-center my-5">支援者区分変更</p>
                    <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                        <form>
                            <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">ID</span>
                                    <input type="text" class="form-control fs-5 " placeholder="<?= $record["belongs_id"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">支援者区分</span>
                        <input type="text" name="belongs" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <form>
                            <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                                <div class="input-group justify-content-center">
                                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                    <input type="text" class="form-control fs-5 " placeholder="<?= $record["belongs"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                    <a class="btn btn-secondary btn-lg fs-5" style="width: 250px;;height:50px" href="admin_belongs_read.php" role="button">支援者区分変更・追加へ</a>
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