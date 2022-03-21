<?php
// DB接続
// 各種項目設定
include('functions.php');
session_start();
check_session_id();

// DB接続
$pdo = connect_to_db();


$sql = 'SELECT * FROM member_table ORDER BY member_id ASC';

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
    $output .= "<tr><td>{$record['member_id']}</td><td>{$record['mbname']}</td><td>{$record['seibetu']}</td><td>{$record['barthday']}</td><td>{$record['mbaddress']}</td><td>{$record['is_admin']}</td><td>{$record['is_dalete']}</td>
    <td>
        <a href='member_edit.php?id={$record["member_id"]}' class='btn btn-success' role='button'>変更</a>
      </td>
      <td>
        <a href='member_delete.php?id={$record["member_id"]}' class='btn btn-success' role='button'>削除</a>
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
    <header>
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
            <div class="container-fluid">
                <div class="row justify-content-center  g-2">
                    <p class="h2 text-center my-5">利用者情報照会・変更</p>
                    <div class="table-responsive">
                        <table class="table table-success table-hover mx-auto fs-5" style="max-width: 1000px;">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">名前</th>
                                    <th scope="col">性別</th>
                                    <th scope="col">生年月日</th>
                                    <th scope="col">住所</th>
                                    <th scope="col">利用者区分</th>
                                    <th scope="col">停止区分</th>
                                    <th scope="col">変更</th>
                                    <th scope="col">削除</th>
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
                        <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="admin_home.php" role="button">管理者ホームへ</a>
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