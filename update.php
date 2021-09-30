<?php

require_once('dbc.php');
$id = $_GET['id'];
$result = output_pw($id);

$id = $result['id'];
$sb_name = $result['sb_name'];
$join_date = $result['join_date'];
$money = $result['money'];
$link = $result['link'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サブスク更新</title>
</head>

<body>
    <h2>サブスク更新</h2>
    <form action="update_table.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <p>サブスク名</p>
        <input type="text" name="sb_name" value="<?php echo $sb_name ?>">
        <p>入会日</p>
        <input type="date" name="join_date" value="<?php echo $join_date ?>">
        <p>金額</p>
        <input type="text" name="money" value="<?php echo $money ?>">
        <p>リンク</p>
        <input type="text" name="link" value="<?php echo $link ?>">
        <input type="submit" value="更新">
    </form>
    <p><a href="index.php">Back</a></p>

</body>

</html>
