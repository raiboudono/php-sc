<?php

try {
  $dsn = 'mysql:127.0.0.1;utf8mb4';

  $username = 'root';
  $password = 'mocotarou0419';
  $pdo = new PDO($dsn, $username, $password);
  $result = $pdo->exec('delete from crud_db.crud where id >= 10');
  echo "削除したレコード数" . $result;
} catch (\Exception $e) {
  echo "失敗" ;
}

 ?>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <a href="/">戻る</a>
   </body>
 </html>
