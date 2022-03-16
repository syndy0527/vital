<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
// DB接続
$pdo = connect_to_db();


$sql = "SELECT friend_table.member_id,mbname FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id WHERE friend_table.member_id=$id;";

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
    $output .= "<li class='list-group-item list-group-item-success fs-4'>{$record['mbname']}</li>";
    // $output .= "<tr><td>{$record['mbname']}</td><tr>";
};
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="container-fluid">
        <div class="row justify-content-center  g-2">
            <p class="h2 text-center my-5">友達一覧</p>
            <div class="col text-center">
                <ul class="list-group mx-auto" style="max-width: 400px;" id="calling">
                    <?= $output ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center ">
                <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 150px;;height:50px" href="member_kaiwa.php" role="button">友達と話すへ</a>
                <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 150px;;height:50px" href="member_friend_select.php" role="button">友達追加へ</a>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
    <!-- <fieldset>
        <legend>友達一覧</legend>
        <a href="member_kaiwa.php">友達と話すへ</a>
        <table border="1">
            <thead>
                <tr>
                    <th>友達</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
    </fieldset> -->
</body>

</html>