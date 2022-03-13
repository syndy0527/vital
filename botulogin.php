<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="css/style_login.css">

</head>

<body>
    <div class="home_top">
        <h1>コミクト</h1>
    </div>
    <form action="login_act.php" method="POST">
        <fieldset class="login">
            <!-- <legend>ログイン画面</legend> -->
            <div class="login_date">
                <p>今日は <span id="date"></span>です</p>
            </div>
            <div>
                <p class="login_text">ログインID</p>
                <input type="text" name=" logid" class="login_input">
            </div>
            <div>
                <p class="login_text">パスワード</p>
                <input type="password" name="password" class="login_input">
            </div>
            <div class="login_button">
                <button class="button">Login</button>
            </div>
            <div class="login_new">
                <p>登録をされていない方は、<a href="register.php">新規登録へ</a></p>
            </div>
        </fieldset>
    </form>
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