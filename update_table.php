<?php

require_once('dbc.php');
$input = $_POST;

if (empty($input['sb_name'])) {
    exit('サブスク名を入力してください');
}
if (mb_strlen($input['sb_name']) > 128) {
    exit('サブスク名を128文字以下で入力してください。');
}
if (empty($input['join_date'])) {
    exit('入会日を入力してください。');
}
if (empty($input['money'])) {
    exit('金額を入力してください。');
}
if (empty($input['link'])) {
    exit('リンクを入力してください。');
}


$dbh = dbconnect();

$sql = 'UPDATE gs_sb_table SET
            sb_name=:sb_name,join_date=:join_date,money=:money,link=:link
        WHERE
            id=:id';

$dbh = dbconnect();
$dbh->beginTransaction();

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', (int)$input['id'], PDO::PARAM_INT);
    $stmt->bindValue(':sb_name', $input['sb_name'], PDO::PARAM_STR);
    $stmt->bindValue(':join_date', $input['join_date'], PDO::PARAM_STR);
    $stmt->bindValue(':money', $input['money'], PDO::PARAM_INT);
    $stmt->bindValue(':link', $input['link'], PDO::PARAM_STR);
    $stmt->execute();
    $dbh->commit();
    echo '更新が完了しました';
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}

?>

<p><a href="index.php">サブスク管理画面に戻る</a></p>
