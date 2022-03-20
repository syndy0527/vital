<?php
// var_dump($_GET);
// exit();

if (
    !isset($_GET['id']) || $_GET['id'] == ''
) {
    exit('Paramerror');
}

$sien_id = $_GET['id'];
include("functions.php");
session_start();
check_session_id();

$id = $_SESSION['member_id'];

// 基本情報一覧
$pdo = connect_to_db();
$sql = 'SELECT * FROM member_table WHERE member_id=:sien_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($record);
// exit();

// 親族状況一覧
$pdo = connect_to_db();
$sql = 'SELECT * FROM sinzoku_table WHERE member_id=:sien_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($val as $record1) {
    $output .= "<tr><td>{$record1['sinzokuname']}</td><td>{$record1['sinzokuadd']}</td><td>{$record1['sinzokugara']}</td><td>{$record1['sinzokutel']}</td></tr>";
}

// 介護認定登録状況
$sql = "SELECT member_id,medical_table.kaigonintei_id,kaigonintei FROM `medical_table` LEFT OUTER JOIN kaigonintei_table ON medical_table.kaigonintei_id=kaigonintei_table.kaigonintei_id WHERE member_id=:sien_id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$kaigo1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($kaigo1['kaigonintei']) || $kaigo1['kaigonintei'] == '' ||
    !isset($kaigo1['member_id']) || $kaigo1['member_id'] == '' ||
    !isset($kaigo1['kaigonintei_id']) || $kaigo1['kaigonintei_id'] == ''
) {
    $kaigo1['kaigonintei'] = NULL;
    $kaigo1['member_id'] = NULL;
    $kaigo1['kaigonintei_id'] = NULL;
}
// var_dump($kaigo1["member_id"]);
// exit();

// 障がい区分登録状況
$sql = "SELECT member_id,medical_table.shougainintei_id,shougai FROM `medical_table` LEFT OUTER JOIN shougai_table ON medical_table.shougainintei_id=shougai_table.shougai_id WHERE member_id=:sien_id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$shougai1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($shougai1['shougai']) || $shougai1['shougai'] == '' ||
    !isset($shougai1['member_id']) || $shougai1['member_id'] == '' ||
    !isset($shougai1['shougainintei_id']) || $shougai1['shougainintei_id'] == ''
) {
    $shougai1['shougai'] = NULL;
    $shougai1['member_id'] = NULL;
    $shougai1['shougainintei_id'] = NULL;
}
// var_dump($shougai1["member_id"]);
// exit();

// ケアマネ登録状況
$sql = "SELECT  result1_table.member_id,result1_table.mbname,belongs FROM (SELECT result_table.member_id,result_table.mbname,belongs_id FROM (SELECT medical_table.member_id,medical_table.caremane,caredocter,mbname FROM `medical_table` LEFT OUTER JOIN member_table ON medical_table.caremane=member_table.member_id) AS result_table LEFT OUTER JOIN supporter_table ON result_table.caremane=supporter_table.member_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id WHERE member_id=:sien_id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result1 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($result1['mbname']) || $result1['mbname'] == '' ||
    !isset($result1['member_id']) || $result1['member_id'] == '' ||
    !isset($result1['belongs']) || $result1['belongs'] == ''
) {
    $result1['mbname'] = NULL;
    $result1['member_id'] = NULL;
    $result1['belongs'] = NULL;
}
// echo '<pre>';
// var_dump($result1['member_id']);
// echo '<pre>';
// exit();
$output3 = "{$result1['mbname']} / {$result1['belongs']} ";

// ケアマネ登録状況
$sql = "SELECT  result1_table.member_id,result1_table.mbname,belongs FROM (SELECT result_table.member_id,result_table.mbname,belongs_id FROM (SELECT medical_table.member_id,medical_table.caremane,caredocter,mbname FROM `medical_table` LEFT OUTER JOIN member_table ON medical_table.caredocter=member_table.member_id) AS result_table LEFT OUTER JOIN supporter_table ON result_table.caredocter=supporter_table.member_id) AS result1_table LEFT OUTER JOIN belongs_table ON result1_table.belongs_id=belongs_table.belongs_id WHERE member_id=:sien_id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result3 = $stmt->fetch(PDO::FETCH_ASSOC);
if (
    !isset($result3['mbname']) || $result3['mbname'] == '' ||
    !isset($result3['member_id']) || $result3['member_id'] == '' ||
    !isset($result3['belongs']) || $result3['belongs'] == ''
) {
    $result3['mbname'] = NULL;
    $result3['member_id'] = NULL;
    $result3['belongs'] = NULL;
}
$output5 = "{$result3['mbname']} / {$result3['belongs']} ";

// バイタル状況
$pdo = connect_to_db();
$sql = 'SELECT * FROM vital_table WHERE member_id=:sien_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sien_id', $sien_id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($val);
// exit();
// echo '<pre>';

$output6 = "";
foreach ($val1 as $record2) {
    // var_dump($record['record_date']);
    // exit();
    $fukuyaku = "";
    if ($record2['fukuyaku'] == 1) {
        $fukuyaku .= "飲んだ";
    } else if ($record2['fukuyaku'] == 2) {
        $fukuyaku .= "飲んでない";
    };
    $output6 .= "<tr><td>{$record2['record_date']}</td><td>{$record2['taion']}℃</td><td>{$record2['ketuatu_up']}/{$record2['ketuatu_down']}</td><td>{$record2['myakuhaku']}</td><td>{$record2['wight']}</td><td>{$record2['suibun']}</td><td>{$fukuyaku}</td></tr>";
}

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
        <nav class="navbar navbar-light bg-primary bg-opacity-25">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">

                    <form class="d-flex fs-4">
                        <span class="navbar-text h5 ">
                            支援者:<?= $_SESSION['mbname'] ?>
                        </span>
                        <a class="btn btn-secondary" href="logout.php" role="button">ログアウト</a>
                    </form>
            </div>
        </nav>
    </header>
    <main class="mb-5">
        <div class="container-fluid">
            <div class="row justify-content-center  g-3">
                <p class="h2 text-center my-4">基本情報</p>
                <div class="col-lg-2 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">氏名</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["mbname"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-2 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">性別</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["seibetu"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-2 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">生年月日</span>
                                <input type="text" class="form-control fs-5" placeholder="<?= $record["barthday"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-auto text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center mb-3 ">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">住所</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $record["mbaddress"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
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
            <div class="row justify-content-center  g-3">
                <p class="h2 text-center my-4">医療情報</p>
                <div class="col-lg-2 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">介護認定</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $kaigo1["kaigonintei"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-2 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">障がい認定</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $shougai1["shougai"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-4 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">ケアマネジャー</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $output3 ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-4 text-center">
                    <form>
                        <fieldset disabled class="input-group justify-content-center">
                            <div class="input-group justify-content-center">
                                <span class="input-group-text fs-5" id="inputGroup-sizing-default">かかつけ医師</span>
                                <input type="text" class="form-control fs-5 " placeholder="<?= $output5 ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">健康情報一覧</p>
                <div class="table-responsive">
                    <table class="table table-secondary table-hover mx-auto fs-5" style="max-width: 960px;">
                        <thead>
                            <tr>
                                <th scope="col">登録日</th>
                                <th scope="col">体温</th>
                                <th scope="col">血圧</th>
                                <th scope="col">脈拍</th>
                                <th scope="col">体重</th>
                                <th scope="col">水分量</th>
                                <th scope="col">服薬状況</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $output6 ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ms-3 my-5 bg-light bg-opacity-50">
                    <div id="canvas-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col text-center ms-3 my-5 bg-light bg-opacity-50">
                    <div id="canvas-container">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ms-3 my-5 bg-light bg-opacity-50">
                    <div id="canvas-container">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
                <div class="col text-center ms-3 my-5 bg-light bg-opacity-50">
                    <div id="canvas-container">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ms-3 my-5 bg-light bg-opacity-50">
                    <div id="canvas-container">
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
                <div class="col text-center ms-3 my-5">
                    <div id="canvas-container">
                        <canvas id="myChart5"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ">
                    <a class="btn btn-secondary btn-lg fs-5 ms-5 my-3" style="width: 200px;;height:50px" href="sien_mimamori.php" role="button">見守り情報へ</a>
                    <a class="btn btn-secondary btn-lg fs-5 ms-5 my-3" style="width: 200px;;height:50px" href="sien_mimamori_select.php" role="button">健康情報登録へ</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
    <script>
        let data_array = <?php echo json_encode($val1); ?>;
        date_array = [];
        taion_array = [];
        ketuatu_up_array = [];
        ketuatu_down_array = [];
        myakuhaku_array = [];
        wight_array = [];
        suibun_array = [];
        for (let i = 0; i < data_array.length; i++) {
            date_array.push(data_array[i].record_date);
            taion_array.push(data_array[i].taion);
            ketuatu_up_array.push(data_array[i].ketuatu_up);
            ketuatu_down_array.push(data_array[i].ketuatu_down);
            myakuhaku_array.push(data_array[i].myakuhaku);
            wight_array.push(data_array[i].wight);
            suibun_array.push(data_array[i].suibun);
        }
        console.log(data_array);
        console.log(date_array);
        console.log(taion_array);
        console.log(ketuatu_up_array);
        console.log(ketuatu_down_array);
        console.log(myakuhaku_array);
        console.log(wight_array);
        console.log(suibun_array);

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_array,
                datasets: [{
                    label: '体温',
                    data: taion_array,
                    borderColor: "rgba(255,0,0,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }, ],
            },
            options: {
                title: {
                    display: true,
                    text: '気温（8月1日~8月7日）'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 40,
                            suggestedMin: 30,
                            stepSize: 0.5,
                            maxTicksLimit: 7

                        }
                    }]
                },
            }
        });

        var ctx = document.getElementById("myChart1");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_array,
                datasets: [{
                    label: '血圧（上）',
                    data: ketuatu_up_array,
                    borderColor: "rgba(0,155,198,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }, {
                    label: '血圧（下）',
                    data: ketuatu_down_array,
                    borderColor: "rgba(122,203,225,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }],
            },
            options: {
                title: {
                    display: true,
                    text: '気温（8月1日~8月7日）'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 40,
                            suggestedMin: 30,
                            stepSize: 0.5,

                        }
                    }]
                },
            }
        });
        var ctx = document.getElementById("myChart2");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_array,
                datasets: [{
                    label: '脈拍',
                    data: myakuhaku_array,
                    borderColor: "rgba(153,68,204,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }],
            },
            options: {
                title: {
                    display: true,
                    text: '気温（8月1日~8月7日）'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 40,
                            suggestedMin: 30,
                            stepSize: 0.5,

                        }
                    }]
                },
            }
        });
        var ctx = document.getElementById("myChart3");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_array,
                datasets: [{
                    label: '体重',
                    data: wight_array,
                    borderColor: "rgba(51,153,0,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }],
            },
            options: {
                title: {
                    display: true,
                    text: '気温（8月1日~8月7日）'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 40,
                            suggestedMin: 30,
                            stepSize: 0.5,

                        }
                    }]
                },
            }
        });
        var ctx = document.getElementById("myChart4");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_array,
                datasets: [{
                    label: '水分量(ml)',
                    data: suibun_array,
                    borderColor: "rgba(58,172,173,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                }],
            },
            options: {
                title: {
                    display: true,
                    text: '気温（8月1日~8月7日）'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 40,
                            suggestedMin: 30,
                            stepSize: 100,

                        }
                    }]
                },
            }
        });
    </script>
</body>

</html>