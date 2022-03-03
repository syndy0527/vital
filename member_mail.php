<?php
// var_dump($_GET);
// exit();
$recieve_id = $_GET["id"];


include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];

//送信ユーザー情報の抽出
$pdo = connect_to_db();
$sql = 'SELECT member_id,mbname FROM member_table WHERE member_id=:id AND	is_dalete=0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$current_user = $stmt->fetch(PDO::FETCH_ASSOC);

//受信ユーザー情報の抽出
$pdo = connect_to_db();
$sql = 'SELECT member_id,mbname FROM member_table WHERE member_id=:id AND	is_dalete=0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $recieve_id, PDO::PARAM_INT);
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$destination_user = $stmt->fetch(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($destination_user["mbname"]);
// echo '<pre>';
// exit();

//メッセージの抽出
$pdo = connect_to_db();
$sql = 'SELECT * FROM communicate_table WHERE (send_member_id=:id and recieve_member_id=:recieve_id) or (send_member_id=:recieve_id and recieve_member_id=:id) ORDER BY created_at ASC';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':recieve_id', $recieve_id, PDO::PARAM_INT);
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

function convert_to_fuzzy_time($time_db)
{
    date_default_timezone_set('Asia/Tokyo');

    $unix   = strtotime($time_db);
    $now    = time();
    $diff_sec   = $now - $unix;

    if ($diff_sec < 60) {
        $time   = $diff_sec;
        $unit   = "秒前";
    } elseif ($diff_sec < 3600) {
        $time   = $diff_sec / 60;
        $unit   = "分前";
    } elseif ($diff_sec < 86400) {
        $time   = $diff_sec / 3600;
        $unit   = "時間前";
    } elseif ($diff_sec < 2764800) {
        $time   = $diff_sec / 86400;
        $unit   = "日前";
    } else {
        if (date("Y") != date("Y", $unix)) {
            $time   = date("Y年n月j日", $unix);
        } else {
            $time   = date("n月j日", $unix);
        }

        return $time;
    }

    return (int)$time . $unit;
}
// echo '<pre>';
// var_dump($messages);
// echo '<pre>';
// exit();


// $sql = "SELECT friend_table.friend_id,mbname FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id;";

// $stmt = $pdo->prepare($sql);


// // SQL実行（実行に失敗すると `sql error ...` が出力される）
// try {
//     $status = $stmt->execute();
// } catch (PDOException $e) {
//     echo json_encode(["sql error" => "{$e->getMessage()}"]);
//     exit();
// }

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $output = "";
// foreach ($result as $record) {
//     $output .= "<option value='{$record['friend_id']}'>{$record['mbname']}</option>";
// };

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コミュニケーションボード</title>
    <link rel="stylesheet" href="css/style_mail.css">
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

    <div class="message">
        <h2 class="center">話相手：<?= $destination_user["mbname"] ?></h2>
        <?php foreach ($messages as $message) : ?>
            <div class="my_message">
                <?php if ($message['send_member_id'] == $current_user['member_id']) : ?>
                    <span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
                    <div class="mycomment_right">
                        <p><?= $message['text'] ?></p>
                    </div>
                <?php else : ?>
                    <div class="left">
                        <div class="chatting">
                            <div class="says"><?= $message['text'] ?></div><span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach ?>

        <div class="message_send">
            <div>
                <h3>メッセージ送信</h3>
            </div>
            <div>
                <form action="member_mail_send.php" method="POST" enctype="multipart/form-data">
                    <div>
                        コメント：<textarea name="text" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <input type="file" name="upfile" accept="image/*" capture="camera" />
                    </div>
                    <input type="hidden" name="id" value="<?= $_SESSION['member_id']  ?>">
                    <input type="hidden" name="recieve_id" value="<?= $recieve_id  ?>">
                    <div>
                        <button>submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="top">
        <a class="gohome" href="member_mail_select.php">友達一覧へ</a>
    </div>

</body>

</html>