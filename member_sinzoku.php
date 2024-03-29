<?php
include('functions.php');
session_start();
check_session_id();

// DB接続
$memberid = $_SESSION['member_id'];
$pdo = connect_to_db();
$sql = 'SELECT * FROM sinzoku_table WHERE member_id=:memberid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':memberid', $memberid, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($val as $record) {
    $output .= "<tr><td>{$record['sinzokuname']}</td><td>{$record['sinzokuadd']}</td><td>{$record['sinzokugara']}</td><td>{$record['sinzokutel']}</td></tr>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>親族登録</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-danger bg-opacity-25">
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
                            <a class="nav-link text-dark fw-bold fs-4" href="#">利用者:<?= $_SESSION['mbname'] ?></a>
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
        <form action="member_sinzoku_update.php" method="POST">
            <div class="container-fluid">
                <div class="row justify-content-center  g-2">
                    <p class="h2 text-center my-5">親族登録</p>
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">親族氏名</span>
                        <input type="text" name="sinzokuname" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="row justify-content-center  g-2">
                        <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                            <span class="input-group-text fs-5" id="inputGroup-sizing-default">親族住所</span>
                            <input type="text" name="sinzokuadd" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="row justify-content-center  g-2">
                        <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                            <span class="input-group-text fs-5" id="inputGroup-sizing-default">親族続柄</span>
                            <input type="text" name="sinzokugara" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="row justify-content-center  g-2">
                        <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                            <span class="input-group-text fs-5" id="inputGroup-sizing-default">親族TEL</span>
                            <input type="text" name="sinzokutel" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
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
                    <input type="hidden" name="id" value="<?= $memberid ?>">
                </div>
        </form>
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">登録親族一覧</p>
                <div class="table-responsive">
                    <table class="table table-secondary table-hover mx-auto fs-5" style="max-width: 1000px;">
                        <thead>
                            <tr>
                                <th scope="col">親族氏名</th>
                                <th scope="col">親族住所</th>
                                <th scope="col">親族続柄</th>
                                <th scope="col">親族TEL</th>
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
                    <a class="btn btn-secondary btn-lg fs-5" style="width: 200px;;height:50px" href="member_input.php" role="button">基本情報入力へ</a>
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