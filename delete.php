<?php

require_once('dbc.php');
$id = $_GET['id'];

$dbh = dbconnect();

$sql = 'DELETE FROM gs_sb_table WHERE id=:id';

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
$stmt->execute();
echo 'サブスク削除が完了しました' . PHP_EOL;
echo 'サイトでの退会手続きもお忘れなく！';

?>

<p><a href="index.php">サブスク管理画面に戻る</a></p>
