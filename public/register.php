<?php

session_start();
require_once '../classes/UserLogic.php';
ini_set('display_errors', true);

//Error
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');

//token無しOR違う
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエスト');
}

//Variation
if (!$username = filter_input(INPUT_POST, 'username')) {
    $err[] = '※ ユーザー名を入力してください';
}

if (!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = '※ emailを入力してください';
}

if ($email = filter_input(INPUT_POST, 'email')) {
    $err[] = '※ 既に登録済みのemailがあります\n別のemailで登録してください';
}

$password = filter_input(INPUT_POST, 'password');
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
    $err[] = '※ パスワードは8~100文字の間で設定してください';
}

$password_conf = filter_input(INPUT_POST, 'password_conf');
if ($password !== $password_conf) {
    $err[] = '※ パスワードと確認用パスワードが異なります';
}

if (count($err) === 0) {
    $hasCreated = UserLogic::createUser($_POST);

    if (!$hasCreated) {
        $err[] = '※ ユーザー登録に失敗しました';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録完了</title>
</head>

<body>
    <?php if (count($err) > 0) : ?>
        <?php foreach ($err as $e) : ?>
            <p><?php echo $e ?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <p>ユーザー登録完了が完了しました！</p>
    <?php endif ?>
    <p><a href="signup.php">戻る</a></p>
</body>

</html>
