<?php

$name = $_POST['username'];
$email = $_POST['email'];

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サブスク登録</title>
</head>

<body>
    <h2>サブスク登録</h2>
    <form action="input.php" method="POST">
        <p>サブスク名</p>
        <input type="text" name="sb_name">
        <p>入会日</p>
        <input type="date" name="join_date">
        <p>月額</p>
        <input type="text" name="money">
        <p>リンク</p>
        <input type="text" name="link">
        <input type="hidden" name="username" value="<?php echo ($name) ?>">
        <input type="hidden" name="email" value="<?php echo ($email) ?>">
        <input type="submit" value="登録">
    </form>
    <p><a href="index.php">サブスク管理画面に戻る</a></p>

</body>

</html>
