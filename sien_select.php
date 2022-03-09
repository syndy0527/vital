<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支援追加</title>
    <link rel="stylesheet" href="css/style_sien_page.css">
</head>

<body>
    <header class="header">
        <div class="home_head">
            <p>支援者:
                <?= $_SESSION['mbname'] ?>
            </p>
        </div>
        <div class="home_head_text">
            <p><a href="logout.php">ログアウト</a></p>
        </div>

    </header>
    <div class="field_main">
        <form action="sien_add.php" method="POST">
            <fieldset class="field_set">
                <legend>支援対象者の追加</legend>
                <div>
                    支援対象者検索：<input type="text" id="search">
                </div>
                <div>
                    <select name="id" id="table"></select>
                    <input type='checkbox' name='sien' value='1'> <label for="">追加</label>
                </div>
                <!-- <table>
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>追加</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table">
                    <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
                <!-- </tbody>
            </table> -->
                <div>
                    <button>支援対象者を追加</button>
                </div>
                <a href="sien_list.php">支援対象者一覧へ</a>
            </fieldset>
    </div>
    <div class="top_content">
        <div class="top">
            <a class="gohome" href=" sien_home.php"><span>支援者ホームへ</span></a>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $('#search').on('keyup', function(e) {
            console.log(e.target.value);
            const searchWord = e.target.value;
            const requestUrl = "sien_get.php";

            // ajax_search.html

            axios
                .get(`${requestUrl}?searchword=${searchWord}`)
                .then(function(response) {
                    console.log(response.data);
                    const array = [];
                    response.data.forEach(element => {
                        // array.push(`<tr><td>'${element.mbname}'</td><td><input type='hidden' name='friend[]' value='0' ></td><td><input type='checkbox' name='friend[]' value='1'></td><td><input type='hidden' name='id[]' value='${element.member_id}'></td><tr>`)
                        array.push(`<option value='${element.member_id}'>'${element.mbname}'</option>`)
                    });
                    $("#table").html(array);
                })
                .catch(function(error) {
                    // 省略
                })
        });
    </script>
    </form>
</body>

</html>