<?php

$id = $_GET['id'];

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'all', '');
} catch (PDOException $e) {
  exit('DbConnectError:' . $e->getMessage());
}

$sql = 'DELETE FROM gs_login_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

echo 'サブスク削除が完了しました' . PHP_EOL;
echo 'サイトでの退会手続きもお忘れなく！';

?>

<p><a href="manager.php">ユーザー管理画面に戻る</a></p>
