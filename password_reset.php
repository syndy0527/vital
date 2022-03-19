<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセット画面</title>
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
            <h2 class="text-center text-secondary pt-5 fs-1 ">パスワードリセット</h2>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="password_reset_act.php" method="POST">
                                <div class="form-group">
                                    <label for="username" class="text-secondary fs-3 mt-3">ログインID:</label><br>
                                    <input type="text" name=" logid" id="username" class="form-control fs-3 ">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-secondary fs-3 mt-3">旧パスワード:</label><br>
                                    <input type="password" name="old_password" id="old_password" class="form-control fs-3">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-secondary fs-3 mt-3">新パスワード:</label><br>
                                    <input type="password" name="new_password" id="new_password" class="form-control fs-3">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-secondary fs-3 mt-3">新パスワード(確認) :</label><br>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control fs-3" onkeyup="setConfirmMessage(this.value);">
                                </div>
                                <div id="pass_confirm_message" class="text-danger fs-3 mt-3"></div>
                                <div class="form-group d-grid gap-2 col-6 mx-auto">
                                    <!-- <label for="remember-me" class="text-secondary fs-3 my-3"><span>パスワードを記録する</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                    <input type="submit" name="submit" class="btn btn-danger btn-md fs-3 my-4 " value="パスワードを変更する">
                                </div>
                                <div id="register-link" class="text-right fs-3 my-3">
                                    <p>変更をしない方は、<a href="login.php" class="text-info text-danger fs-3">ログインへ</a></p>
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
    <script>
        function setConfirmMessage(confirm_password) {
            let password = document.getElementById("new_password").value;
            let message = "";
            if (password == confirm_password) {
                message = "";
            } else {
                message = "パスワードが一致しません";
            }

            let div = document.getElementById("pass_confirm_message");
            if (!div.hasFistChild) {
                div.appendChild(document.createTextNode(""));
            }
            div.firstChild.data = message;
        }
    </script>
</body>


</html>