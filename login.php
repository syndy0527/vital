<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>

</head>

<body>
    <form action="login_act.php" method="POST">
        <fieldset>
            <legend>ログイン画面</legend>
            <div>
                <p>今日は <span id="date"></span>です</p>
            </div>
            <div>
                ログインID: <input type="text" name=" logid">
            </div>
            <div>
                パスワード: <input type="text" name="password">
            </div>
            <div>
                <button>Login</button>
            </div>
            <p>登録をされていない方は、<a href="register.php">新規登録へ</a></p>

        </fieldset>
        <script>
            const now = new Date()
            const month = now.getMonth()
            const date = now.getDate()
            const weeks = ["（日）", "（月）", "（日）", "（水）", "（木）", "（金）", "（土）"];
            const weeknb = now.getDay()
            const weekdays = weeks[weeknb]
            const output = ` ${month+1}月 ${date}日${weekdays}`
            document.getElementById("date").textContent = output;
            console.log(output)
        </script>
</body>


</html>