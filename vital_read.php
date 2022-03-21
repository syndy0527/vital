<?php
include('functions.php');
session_start();
check_session_id();

$memberid = $_SESSION['member_id'];
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT * FROM vital_table WHERE member_id=:memberid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':memberid', $memberid, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// var_dump($val);
// exit();
// echo '<pre>';

$output = "";
foreach ($val as $record) {
    // var_dump($record['record_date']);
    // exit();
    $fukuyaku = "";
    if ($record['fukuyaku'] == 1) {
        $fukuyaku .= "飲んだ";
    } else if ($record['fukuyaku'] == 2) {
        $fukuyaku .= "飲んでない";
    };
    $output .= "<tr><td>{$record['record_date']}</td><td>{$record['taion']}℃</td><td>{$record['ketuatu_up']}/{$record['ketuatu_down']}</td><td>{$record['myakuhaku']}</td><td>{$record['wight']}</td><td>{$record['suibun']}</td><td>{$fukuyaku}</td></tr>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>健康情報一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_member_page.css">
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
                            <?= $output ?>
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
                <div class="col text-center my-5">
                    <a class="btn btn-secondary btn-lg fs-5 ms-5 my-3" style="width: 200px;;height:50px" href="vital_check.php" role="button">健康チェックへ</a>
                    <a class="btn btn-secondary btn-lg fs-5 ms-5 my-3" style="width: 200px;;height:50px" href="vital.php" role="button">健康情報登録へ</a>
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
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
    <script>
        let data_array = <?php echo json_encode($val); ?>;
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