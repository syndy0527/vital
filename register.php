<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録画面</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_home.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-warning bg-opacity-75">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/comictlogo.png" alt="" width="300" height="60" class="d-inline-block align-text-top">
                </a>
                <form class="d-flex fs-4">
                    <a class="btn btn-outline-danger fs-4 mx-4" href="login.php" role="button">ログイン</a>
                    <a class="btn btn-outline-danger fs-4 " href="register.php" role="button">新規登録</a>
                </form>
            </div>
        </nav>
    </header>
    <main>
        <div id="login" class="login">
            <h2 class="text-center text-secondary pt-5 fs-1 ">新規登録</h2>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="register_act.php" method="POST">
                                <div class="form-group">
                                    <label for="mbname" class="text-secondary fs-3 mt-3">名前:</label><br>
                                    <input type="text" name="mbname" id="mbname" class="form-control fs-3 ">
                                </div>
                                <div class="form-group">
                                    <label for="logid" class="text-secondary fs-3 mt-3">ログインID:</label><br>
                                    <input type="text" name="logid" id="logid" class="form-control fs-3 ">
                                    <label for="logid" class="text-secondary fs-3 mt-3">※半角英数４文字で入力してください。
                                    </label><br>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-secondary fs-3 mt-3">パスワード:</label><br>
                                    <input type="password" name="password" id="password" class="form-control fs-3">
                                    <label for="logid" class="text-secondary fs-3 mt-3">※半角英数6文字で入力してください。
                                </div>
                                <div class="form-group d-grid gap-2 col-6 mx-auto">
                                    <!-- <label for="remember-me" class="text-secondary fs-3 my-3"><span>パスワードを記録する</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                    <input type="submit" name="submit" class="btn btn-danger btn-md fs-3 my-4 " value="登録する">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer fixed-bottom mt-auto py-2 bg-secondary text-light text-center fs-5 ">
        <div class="container">
            <p>&copy;2022 syndy </p>
        </div>
    </footer>

</html>