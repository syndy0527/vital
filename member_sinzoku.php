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
    <form action="member_sinzoku_update.php" method="POST">
        <fieldset>
            <legend>親族登録</legend>
            <a href="member_input.php">基本情報入力</a>
            <div>
                利用者：<?= $_SESSION['mbname'] ?>
            </div>
            <div>
                親族名前: <input type="text" name="sinzokuname">
            </div>
            <div>
                親族住所: <input type="text" name="sinzokuadd">
            </div>
            <div>
                親族続柄: <input type="text" name="sinzokugara">
            </div>
            <div>
                親族TEL: <input type="tel" name="sinzokutel">
            </div>
            </div>

            <input type="hidden" name="id" value="<?= $memberid ?>">
            <div>
                <button>submit</button>
            </div>
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <th>親族名前</th>
                            <th>親族住所</th>
                            <th>親族続柄</th>
                            <th>親族TEL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $output ?>
                    </tbody>
                </table>

        </fieldset>
    </form>
    <div class="top">
        <a class="gohome" href=" member_input.php"><span>基本情報入力へ</span></a>
    </div>
</body>

</html>