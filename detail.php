<?php

require_once('dbc.php');

$id = $_GET['id'];

$result = output_pw($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Password</title>
</head>
<body>
    <h2>Your Password</h2>
    <p>Name: <?php echo $result['name']?></p>
    <p>Content: <?php echo $result['content']?></p>
    <p>Comment: <?php echo $result['comment']?></p>
    <p>Password: <?php echo $result['pw']?></p>

    <p><a href="index.php">Back</a></p>
</body>
</html>

