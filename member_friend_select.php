<?php
include('functions.php');
session_start();
check_session_id();
$id = $_SESSION['member_id'];
$mbname = $_SESSION['mbname'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>友達追加</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_member_page.css">
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
    <form action="member_friend_add.php" method="POST">
        <div class="container-fluid">
            <div class="row justify-content-center  g-2">
                <p class="h2 text-center my-5">友達の追加</p>
                <div class="input-group mb-3 justify-content-center">
                    <span class="input-group-text fs-5" id="inputGroup-sizing-default">友達検索</span>
                    <input type="text" id="search" class="form-control fs-5 " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="max-width: 400px;">
                </div>
                <div class="input-group mb-3 justify-content-center">
                    <select class="form-select fs-5" name="id" id="table" style="max-width: 400px;"></select>
                    <label class="input-group-text fs-5" for="table">追加</label>
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" name='friend' value="1" aria-label="Checkbox for following text input">
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col text-center mb-5">
                            <button class="btn btn-outline-success btn-lg fs-5" style="width: 200px;;height:50px">友達を追加</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col text-center ">
                    <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 150px;;height:50px" href="member_kaiwa.php" role="button">友達と話すへ</a>
                    <a class="btn btn-secondary btn-lg fs-5 mx-4 my-4" style="width: 150px;;height:50px" href="member_friend_list.php" role="button">友達一覧へ</a>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            $('#search').on('keyup', function(e) {
                console.log(e.target.value);
                const searchWord = e.target.value;
                const requestUrl = "member_friend_get.php";

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