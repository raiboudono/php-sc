<?php
require_once('delete.php');

$u = ['おやつ', 'お肉'];
 ?>
<?php
$dsn = 'mysql:127.0.0.1;utf8mb4';
$username = 'root';
$password = 'mocotarou0419';

try {
  $pdo = new PDO($dsn, $username, $password);
  echo "DB接続成功";

  $pdo->exec('create database crud_db');
  $stmt = $pdo->query('create table crud_db.crud (id int, name varchar(10))');



} catch (PDOException $e) {
  exit($e->getMessage());
}
 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>らいあんのスクラッチブログ</title>
  </head>

  <h1>らいあんのスクラッチブログ</h1>
  <body>
    <div class="form-container">

      <form class="" action="" method="post">
        create: <input type="text" name="c" value="">
        <button type="submit">作成</button>
        <p>POSTで入力/保存された値:<?php print_r($_POST['c'])?></p>
        read:
        <?php if ($_POST): ?>
          <table>
            <tr>
            <?php foreach ($_POST as $key => $val): ?>
              <th><?=$key?>:</th>
              <td><?=$val?></td>
            <?php endforeach; ?>
            </tr>
         </table>
        <?php endif; ?>
        update:
        <p>対象のデータ: <?php foreach($u as $var){echo $var . " ";}?></p>
        <button type="button">更新 </button>
        <?php array_push($u, 'もも');?><br>
        <p>更新後データ: <?php foreach($u as $var){echo $var . " ";}?></p>
        delete:
        <?php $u = [];?><br>
        <p>更新後データ: <?php foreach($u as $var){echo $var . " ";}?></p>
      </form>
    </div>



  </body>
</html>
