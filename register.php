<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="register_act.php" method="POST">
        <fieldset>
            <legend>ユーザ登録画面</legend>
            <div>
                名前: <input type="text" name="mbname">
            </div>
            <div>
                ログインID: <input type="text" name="logid" maxlength="4">
                <p>半角英数４文字で入力してください。</p>
            </div>
            <div>
                パスワード: <input type="text" name="password" minlength="6">
                <p>半角英数６文字以上で入力してください</p>
            </div>
            <div>
                <button>登録</button>
            </div>
            <a href="login.php">ログイン画面へ</a>
        </fieldset>
    </form>
</body>

</html>