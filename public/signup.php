<?php

session_start();
require_once '../public/functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if ($result) {
    header('Location: mypage.php');
    return;
}


$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>

<body>
    <h2>ユーザー登録画面</h2>
    <?php if (isset($login_err)) : ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <p>
            <label for="username">ユーザー名: </label>
            <input type="text" name="username">
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="email" name="email">
        </p>
        <p>
            <label for="password">パスワード: </label>
            <input type="password" name="password">
        </p>
        <p>
            <label for="password_conf">パスワード(確認): </label>
            <input type="password" name="password_conf">
        </p>
        <p>※パスワードは8~100文字の英数字で設定してください</p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()) ?>">
        <p>
            <input type="submit" value="新規登録">
        </p>

    </form>
    <h3><a href="login_form.php">ログインはこちら</a></h3>
    <h3><a href="manager.php">管理者画面はこちら</a></h3>

</body>

</html>
