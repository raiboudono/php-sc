<?php


  try {
    $dsn = 'mysql:127.0.0.1;utf8mb4';

    $username = 'root';
    $password = 'mocotarou0419';
    $pdo = new PDO($dsn, $username, $password);
    echo "DB接続成功";
    $id = $_POST['id'];
    $stmt = $pdo->prepare('delete from crud_db.crud where id = :id');
    $stmt->bindValue('id', $id);
    $stmt->execute();
    echo "削除";
  } catch (\Exception $e) {
    echo "失敗" ;
  }


  ?>

  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
      <a href="/">戻る</a>
    </body>
  </html>
