<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="member_create.php" method="POST">
        <fieldset>
            <legend>メンバー登録</legend>
            <a href="member_read.php">会員一覧画面</a>
            <div>
                氏名：<input type="text" name="mbname">
            </div>
            <div>
                性別：<select name="seibetu">
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </div>
            <div>
                生年月日：<input type="date" name="barthday">
            </div>
            <div>
                住所：<input type="text" name="address">
            </div>
            <div>
                <button>submit</button>
            </div>
        </fieldset>


    </form>

</body>

</html>