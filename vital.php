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
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>利用者:<?= $_SESSION['mbname'] ?></p>
        </div>
        <div class="home_head_text">
            <p><a href="logout.php">ログアウト</a></p>
        </div>
    </header>
    <form action="vital_create.php" method="POST">
        <fieldset>
            <legend>バイタルデータ入力</legend>
            <div>
                利用者：<?= $_SESSION['mbname'] ?>
            </div>
            <div>
                記録日：<input type="date" name="record_date">
            </div>
            <div>
                体温：<input type="number" step="0.1" name="taion">℃
            </div>
            <div>
                血圧：<input type="number" name="ketuatu_up"> / <input type="number" name="ketuatu_down">
            </div>
            <div>
                脈拍：<input type="number" name="myakuhaku">回／分
            </div>
            <div>
                体重：<input type="number" step="0.1" name="wight">kg
            </div>
            <div>
                水分摂取：<input type="nember" name="suibun">ml
            </div>
            <div>
                服薬：<label><input type="radio" name="fukuyaku" value="1">飲んだ</label> <label><input type="radio" name="fukuyaku" value="2">飲んでない</label>
            </div>

            <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>
    <div class="top">
        <a class="gohome" href=" vital_check.php"><span>健康チェックへ</span></a>
    </div>
</body>

</html>