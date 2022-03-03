<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録画面</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <div class="home_top">
        <h1>コミクト</h1>
    </div>
    <form action="register_act.php" method="POST">
        <fieldset class="login">
            <p class="login_top_text">新規登録</p>
            <!-- <legend>ユーザ登録画面</legend> -->
            <div class="login_text">
                <p>名前</p>
                <input type="text" name="mbname" class="login_input">
            </div>
            <div class="login_text">
                <p>ログインID</p>
                <input type="text" name="logid" maxlength="4" class="login_input">
                <p>※半角英数４文字で入力してください。</p>
            </div>
            <div class="login_text">
                <p>パスワード</p>
                <input type="password" name="password" minlength="6" class="login_input">
                <p>※半角英数６文字以上で入力してください</p>
            </div>
            <div class="login_button">
                <button class="button">登録</button>
            </div>
        </fieldset>
        <div class="top">
            <a class="gohome" href=" index.php"><span>ログイン画面へ</span></a>
        </div>
    </form>
</body>

</html>