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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_skyway.css">
    <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.3.js"></script>
    <title>顔を見て話す</title>

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
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="col-sm-6 text-center my-3">
                    <video id="their-video" autoplay playsinline class="img-fluid"></video>
                </div>
                <div class="col-sm-6 text-center my-3">
                    <video id="my-video" autoplay muted playsinline class="img-fluid"></video>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="col text-center">
                    <p class="fs-4">現在テレビ電話ができる友達</p>
                    <!-- <ul class="list-group mx-auto" style="max-width: 400px;" id="calling"> -->
                    <!-- </ul> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col d-none text-center my-3">
                    <p id="my-id"></p>
                </div>
            </div>
        </div>
        <select class="form-select mx-auto bg-success bg-opacity-25 " size="3" aria-label="size 3 select example" style="max-width: 400px;" id="their-id"></select>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center my-5">
                    <button type="button" class="btn btn-outline-success btn-lg fs-5" style="width: 200px;;height:50px" id="make-call">発 信</button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center my-5">
                    <a class="btn btn-secondary btn-lg fs-5" style="width: 150px;;height:50px" href="member_kaiwa.php" role="button">友達と話すへ</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
    <script>
        let localStream;

        // カメラ映像取得
        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: {
                    sampleRate: {
                        ideal: 48000
                    },
                    channelCount: {
                        ideal: 2,
                        min: 1
                    },
                    autoGainControl: true,
                    echoCancellation: true,
                    echoCancellationType: 'system',
                    noiseSuppression: false
                }
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
                // for (i = 0; i < friendmatch.length; i++) {
                //     let li = document.createElement('li');
                //     li.className = "list-group-item list-group-item-success fs-4";
                //     li.textContent = friendmatch[i];
                //     document.getElementById('calling').appendChild(li);
                // }
                for (i = 0; i < friendmatch.length; i++) {
                    let option = document.createElement('option');
                    option.className = "text-center fs-4";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>