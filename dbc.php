<?php

$name = $_POST['username'];
$email = $_POST['email'];

function dbconnect()
{

    $dsn = 'mysql:host=localhost;dbname=gs_db;charset=utf8';
    $user = 'all';
    $pass = null;

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        //echo '接続成功';
    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    };
    return $dbh;
}


function getpw()
{

    $name = $_POST['username'];
    $email = $_POST['email'];

    $dbh = dbconnect();

    //SQL prepration
    $stmt = $dbh->prepare('SELECT name,sb_name,join_date,money,link FROM gs_sb_table WHERE name = :name AND email=:email');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    //SQL action
    $stmt->execute();

    //SQL result recive
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($result);

    return $result;

    $dbh = null;
    // var_dump($bdh);
}

function output_pw($id)
{

    if (empty($id)) {
        exit('idが不正です。');
    }


    $dbh = dbconnect();

    //SQL prepration
    $stmt = $dbh->prepare('SELECT * FROM gs_sb_table WHERE id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    //SQL action
    $stmt->execute();

    //result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($result);

    if (!$result) {
        exit('PWが正しく登録されていません。');
    }

    return $result;
}

function sum()
{
    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'all', '');
    } catch (PDOException $e) {
        exit('DbConnectError:' . $e->getMessage());
    }

    //２．データ抽出SQL作成
    $stmt = $pdo->prepare("SELECT SUM(money) FROM gs_sb_table");
    $status = $stmt->execute();

    $sum = 0;
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:" . $error[2]);
    } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}
