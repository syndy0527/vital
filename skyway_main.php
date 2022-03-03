<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
$mbname = $_SESSION['mbname'];
$login_id = $_SESSION['login_id'];
$login_id_json = json_encode($login_id);

$pdo = connect_to_db();
$sql = "SELECT friend_table.member_id,mbname,login_id FROM `friend_table` LEFT OUTER JOIN member_table ON friend_table.friend_id=member_table.member_id WHERE friend_table.member_id=$id;";
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
$output = [];
foreach ($result as $record) {
    array_push($output, "{$record["login_id"]}");
};
// var_dump($output);
// exit;
$friend = json_encode($output);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_skyway.css">
    <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.3.js"></script>
    <title>顔を見て話す</title>

</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>利用者:
                <?= $_SESSION['mbname'] ?>
            </p>
        </div>
        <div class="home_head_text">
            <p><a href="logout.php">ログアウト</a></p>
        </div>
    </header>
    <div>
        <div class="contena">
            <video id="their-video" width="600px" autoplay muted playsinline></video>
        </div>
        <div class="contena">
            <video id="my-video" width="400px" autoplay muted playsinline></video>
        </div>
        <div class="callfriend">
            <p>現在テレビ電話ができる友達</p>
            <ul id="calling">
            </ul>
        </div>
        <div class="contena">
            <p id="my-id"></p>
        </div>
        <div class="contena">
            <select id="their-id"></select>
            <button id="make-call">発信</button>
        </div>
    </div>
    <div class="top">
        <a class="gohome" href="member_kaiwa.php">友達と話すへ</a>
    </div>
    <script>
        let localStream;

        // カメラ映像取得
        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            })
            .then(stream => {
                // 成功時にvideo要素にカメラ映像をセットし、再生
                const videoElm = document.getElementById('my-video');
                videoElm.srcObject = stream;
                videoElm.play();
                // 着信時に相手にカメラ映像を返せるように、グローバル変数に保存しておく
                localStream = stream;
            }).catch(error => {
                // 失敗時にはエラーログを出力
                console.error('mediaDevice.getUserMedia() error:', error);
                return;
            });

        //Peer作成
        const id = JSON.parse('<?php echo $login_id_json; ?>');
        // console.log(id);
        const peer = new Peer([id], {
            key: '180d2ca9-5d20-48b0-93bf-26b49f4fd8ba',
            debug: 3
        });



        //PeerID取得
        peer.on('open', () => {
            document.getElementById('my-id').textContent = peer.id;
            peer.listAllPeers((peers) => {
                const peerslist = peers;
                const peersme = [id];
                const friend = JSON.parse('<?php echo $friend; ?>');
                const peerslists = peerslist.filter(item =>
                    peersme.indexOf(item) == -1
                );
                const friendmatchs = friend.concat(peerslists)
                const friendmatch = friendmatchs.filter(function(x, i, self) {
                    return self.indexOf(x) === i && i !== self.lastIndexOf(x);
                });
                console.log(friendmatch);
                for (i = 0; i < friendmatch.length; i++) {
                    let li = document.createElement('li');
                    li.textContent = friendmatch[i];
                    document.getElementById('calling').appendChild(li);
                }
                for (i = 0; i < friendmatch.length; i++) {
                    let option = document.createElement('option');
                    option.textContent = friendmatch[i];
                    document.getElementById('their-id').appendChild(option);
                }
            });
        });



        // 発信処理
        document.getElementById('make-call').onclick = () => {
            const theirID = document.getElementById('their-id').value;
            const mediaConnection = peer.call(theirID, localStream);
            setEventListener(mediaConnection);
        };

        // イベントリスナを設置する関数
        const setEventListener = mediaConnection => {
            mediaConnection.on('stream', stream => {
                // video要素にカメラ映像をセットして再生
                const videoElm = document.getElementById('their-video')
                videoElm.srcObject = stream;
                videoElm.play();
            });
        }

        //着信処理
        peer.on('call', mediaConnection => {
            mediaConnection.answer(localStream);
            setEventListener(mediaConnection);
        });

        //PeerIDlist
    </script>
</body>

</html>