<?php

try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'all', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

//データ抽出SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_login_table");
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTD-8');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー管理</title>
</head>

<body>
    <h2>ユーザー管理</h2>
    <h4>登録済みユーザー登録一覧</h4>
    <table border="1">
        <tr>
            <th>ユーザー名</th>
            <th>email</th>
        </tr>
        <?php foreach ($result as $column) : ?>
            <tr>
                <td><?php echo h($column['name']) ?></td>
                <td><?php echo h($column['email']) ?></td>
                <td><a href="user_delete.php?id=<?php echo $column['id'] ?>">強制削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="signup.php">ユーザー登録へ戻る</a>
</body>

</html>
