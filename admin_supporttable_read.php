<?php
// DB接続
// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = 'SELECT * FROM support_table ORDER BY support_id ASC';

$stmt = $pdo->prepare($sql);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
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
$output = "";
foreach ($result as $record) {
    $output .= "<tr><td>{$record['support_id']}</td><td>{$record['support']}</td>
    <td>
        <a href='admin_supporttable_edit.php?id={$record["id"]}' class='btn btn-success' role='button'>変更</a>
      </td><tr>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>利用者一覧（管理者用）</title>
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
    <form action="admin_supporttable_create.php" method="POST">
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">支援区分テーブル追加・変更</p>
                <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default" style="width: 106px;">ID</span>
                    <input type="text" name="id" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">支援者区分</span>
                        <input type="text" name="support" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col text-center mb-5">
                        <button class="btn btn-outline-success btn-lg fs-5" style="width: 200px;;height:50px">新規追加</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container-fluid">
        <div class="row justify-content-center  g-2">
            <div class="table-responsive">
                <table class="table table-success table-hover mx-auto fs-5" style="max-width: 500px;">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">支援者区分</th>
                            <th scope="col">変更</th>
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
                <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="admin_tableadd.php" role="button">テーブル変更・追加へ</a>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
</body>

</html>