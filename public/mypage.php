<?php

session_start();
require_once '../classes/UserLogic.php';
require_once '../public/functions.php';
ini_set('display_errors', true);

$result = UserLogic::checkLogin();

if (!$result) {
    $_SESSION['login_err'] = 'Please register as a user!';
    header('Location: signup.php');
    return;
}

$login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>

<body>
    <h2>マイページ</h2>
    <form action="../index.php" method="POST">
        <p>ユーザー名: <?php echo h($login_user['name']); ?></p>
        <p>Email: <?php echo h($login_user['email']); ?></p>
        <input type="hidden" name="username" value="<?php echo h($login_user['name']) ?>">
        <input type="hidden" name="email" value="<?php echo h($login_user['email']) ?>">
        <input type="submit" name="logout" value="サブスク画面へ">
    </form>
    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="ログアウト">
    </form>
</body>

</html>
