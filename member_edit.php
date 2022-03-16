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
$sql = 'SELECT * FROM member_table WHERE member_id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($record);
// exit();
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
    <form action="member_update.php" method="POST">
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">利用者登録情報変更</p>
                <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">住所</span>
                    <input type="text" name="mbaddress" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <form>
                        <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["mbaddress"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center  g-2">
                <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">利用者区分</span>
                    <select class="form-select fs-5" name="admin" id="">
                        <option value="0">一般</option>
                        <option value="1">支援者</option>
                        <option value="2">管理者</option>
                    </select>
                    <form>
                        <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                <span class="input-group-text fs-5" id="admin"></span>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center  g-2">
                <div class="input-group my-4 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">停止区分</span>
                    <select class="form-select fs-5" name="delete" id="">
                        <option value="0">利用中</option>
                        <option value="1">利用停止</option>
                    </select>
                    <form>
                        <fieldset disabled class="input-group justify-content-center" style="max-width: 400px;">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                <span class="input-group-text fs-5" id="delete"></span>
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
                <input type="hidden" name="id" value="<?= $record["member_id"] ?>">
            </div>
        </div>
    </form>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center my-5">
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="member_read.php" role="button">利用者情報照会へ</a>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
    <script>
        const admin = <?= $record["is_admin"] ?>;
        if (admin === 0) {
            document.getElementById("admin").textContent = "一般";
        } else if (admin === 1) {
            document.getElementById("admin").textContent = "支援者";
        } else if (admin === 2) {
            document.getElementById("admin").textContent = "管理者";
        }
        // console.log(admin);
        const isdelete = <?= $record["is_dalete"] ?>;
        if (isdelete === 0) {
            document.getElementById("delete").textContent = "利用中";
        } else if (isdelete === 1) {
            document.getElementById("delete").textContent = "利用停止";
        }
    </script>
</body>

</html>