<?php
include("functions.php");
session_start();
check_session_id();

$id = $_SESSION['member_id'];
$pdo = connect_to_db();
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
    <title>基本情報登録・変更</title>
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
        <form action="member_create.php" method="POST">
            <div class="container-fluid">
                <div class="row justify-content-center  g-2">
                    <p class="h2 text-center my-5">基本情報登録・変更</p>
                    <div class="col-lg-4 text-center">
                        <div class="input-group mb-3 justify-content-center">
                            <label class="input-group-text fs-5" for="inputGroupSelect01" style="width: 106px;">性 別</label>
                            <select class="form-select fs-5" name="seibetu" id="table">
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                            <form>
                                <fieldset disabled class="input-group justify-content-center">
                                    <div class="input-group justify-content-center">
                                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                        <input type="text" class="form-control fs-5 " placeholder="<?= $record["seibetu"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="col-lg-4 text-center">
                        <div class="input-group mb-3 justify-content-center">
                            <span class=" input-group-text fs-5 " id="inputGroup-sizing-default">生年月日</span>
                            <input type="date" name="barthday" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            <form>
                                <fieldset disabled class="input-group justify-content-center">
                                    <div class="input-group justify-content-center">
                                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                        <input type="text" class="form-control fs-5" placeholder="<?= $record["barthday"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="col-lg-4 text-center">
                        <div class="input-group mb-3 justify-content-center">
                            <span class="input-group-text fs-5" id="inputGroup-sizing-default">住 所</span>
                            <input type="text" name="address" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            <form style="max-width: 400px;">
                                <fieldset disabled class="input-group justify-content-center mb-3 ">
                                    <div class="input-group justify-content-center">
                                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">登録状況</span>
                                        <input type="text" class="form-control fs-5 " placeholder="<?= $record["mbaddress"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col text-center mb-5">
                            <button class="btn btn-outline-success btn-lg fs-5" style="width: 200px;;height:50px">登 録</button>
                            <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ">
                    <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 200px;;height:50px" href="member_input.php" role="button">基本情報入力へ</a>
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