<?php

require_once('dbc.php');
$sbinfo = getpw();

function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTD-8');
}

$result = sum();

//test
$name = $_POST['username'];
$email = $_POST['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
    <title>サブスク管理</title>
</head>

<body>

    <h2>サブスク管理</h2>
    <h5>ユーザー名：<?php echo ($name) ?></h5>
    <h5>Email：<?php echo ($email) ?></h5>
    <h4>登録済みのサブスク一覧</h4>
    <table border="1">
        <tr>
            <th>サブスク名</th>
            <th>入会日</th>
            <th>月額</th>
            <th>リンク</th>
        </tr>
        <?php foreach ($sbinfo as $column) : ?>
            <tr>
                <td><?php echo h($column['sb_name']) ?></td>
                <td><?php echo h($column['join_date']) ?></td>
                <td><?php echo h($column['money']) ?></td>
                <td><?php echo "<a href = " . h($column['link']) . " target = '_blank'" . " >" . h($column['link']) . "</a>" ?></td>
                <td><a href="update.php?id=<?php echo $column['id'] ?>">更新</a></td>
                <td><a href="delete.php?id=<?php echo $column['id'] ?>">削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h4>サブスク合計額（毎月）：<?php echo ($result['SUM(money)']) ?>円</h4>

    <form action="form.php" method="POST">
        <input type="hidden" name="username" value="<?php echo h($name) ?>">
        <input type="hidden" name="email" value="<?php echo h($email) ?>">
        <input type="submit" name="register" value="サブスク新規登録">
    </form>


    <a href="public/mypage.php">マイページへ戻る</a>

    <!-- ボタンを使ったテスト用
    <button id="btn">通知</button> -->

    <script>
        const today = new Date();
        const date = today.getDate();
        const hours = today.getHours();

        // ボタンを使ったテスト用
        // $('#btn').on('click', function() {
        // });

        if (date === 25 && hours === 07) {
            console.log('hello');
            Push.Permission.request();
            Push.create('月末が近づいてきました！', {
                body: 'サブスクの見直しをオススメします！\n今月は' + '<?php echo ($result['SUM(money)']) ?>' + '円の予定です！',
                timeout: 8000, // 通知が消えるタイミング
                onClick: function() {
                    this.close();
                    window.open('http://localhost/php_kadai2/pw/index.php', '_blank');
                }
            });
        }
    </script>

</body>

</html>
