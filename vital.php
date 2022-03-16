<?php
// DB接続
// 各種項目設定
include('functions.php');
session_start();
check_session_id();
// DB接続
// $pdo = connect_to_db();


// $sql = 'SELECT * FROM member_table ORDER BY memberID ASC';

// $stmt = $pdo->prepare($sql);


// // SQL実行（実行に失敗すると `sql error ...` が出力される）
// try {
//     $status = $stmt->execute();
// } catch (PDOException $e) {
//     echo json_encode(["sql error" => "{$e->getMessage()}"]);
//     exit();
// }

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// // echo '<pre>';
// // var_dump($result);
// // echo '<pre>';
// // exit();

// $result_list = "";

// foreach ($result as $result_key) {
//     //     $member = "<option value='" . $member_key['memberID'];
//     //     "'>" . $member_key['mbname'] . "</option>";
//     // $member .= "<option value='" . $member_key['memberID'];
//     // $member .= "'>" . $member_key['mbname'] . "</option>";
//     $result_list .= "<option value='" . $result_key['memberID'] . "'>" . $result_key['mbname'] . "</option>";
// }
// var_dump($member);
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>バイタルデータ入力</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home.css">
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
    <form action="vital_create.php" method="POST">
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">バイタルデータ入力</p>
                <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                    <span class=" input-group-text fs-5 " id="inputGroup-sizing-default">記録日</span>
                    <input type="date" name="record_date" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="row justify-content-center  g-2">
                <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">体温</span>
                    <input type="number" step="0.1" name="taion" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <span class="input-group-text">℃</span>
                </div>
            </div>
            <div class="row justify-content-center  g-2">
                <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">血圧</span>
                    <input type="number" name="ketuatu_up" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <span class="input-group-text">／</span>
                    <input type="number" name="ketuatu_down" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">脈拍</span>
                        <input type="number" name="myakuhaku" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text">回／分</span>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">体重</span>
                        <input type="number" step="0.1" name="wight" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">水分接種</span>
                        <input type="number" name="suibun" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text">ml</span>
                    </div>
                </div>
                <div class="row justify-content-center  g-2">
                    <div class="input-group mb-3 justify-content-center" style="max-width: 400px;">
                        <span class="input-group-text fs-5" id="inputGroup-sizing-default">服薬状況</span>
                        <label class="input-group-text fs-5" for="">飲んだ</label>
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" name="fukuyaku" value="1" aria-label="Checkbox for following text input">
                        </div>
                        <label class="input-group-text fs-5" for="">飲んでない</label>
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" name="fukuyaku" value="2" aria-label="Checkbox for following text input">
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
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col text-center ">
                        <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 200px;;height:50px" href="vital_check.php" role="button">健康チェックへ</a>
                        <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 200px;;height:50px" href="vital_read.php" role="button">健康情報一覧へ</a>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
    </form>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
</body>

</html>