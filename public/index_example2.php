<?php
$dsn = 'mysql:127.0.0.1;utf8mb4';
$username = 'root';
$password = 'mocotarou0419';

try {
  $pdo = new PDO($dsn, $username, $password);
  echo "DB接続成功";

  $pdo->exec('create database crud_db');
  $stmt = $pdo->query('create table crud_db.crud (id int auto_increment, name varchar(10), content varchar(255) not null, primary key(id))');


  $stmt = $pdo->prepare('insert into crud_db.crud (name, content) values(:name, :content)');

  $id = $_POST['id'];
  $name = $_POST['name'];
  $content = $_POST['content'];

  $stmt->bindValue('name', $name);
  $stmt->bindValue('content', $content);
  $stmt->execute();

  $stmt = $pdo->query('select * from crud_db.crud limit 5');
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmt = $pdo->prepare('update crud_db.crud set id=:id, name=:name, content=:content where id =:id');
  $stmt->bindValue('id', (int)$id, PDO::PARAM_INT);
  $stmt->bindValue('name', $name);
  $stmt->bindValue('content', $content);
  $stmt->execute();

  


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
      <form method="post">
        <div>
          <div>
            タイトル: <input type="text" name="name" value="">
          </div>
          <div>
            内容:<textarea name="content" rows="4" cols="40"></textarea>
          </div>
          <button type="submit">記事を投稿</button>
        </div>
        <div>
          記事一覧：
          <table border="2">
            <?php foreach($result as $row): ?>
            <tr>
              <?php foreach($row as $key => $val): ?>
              <th><?=$key?></th>
              <td><?=$val?></td>
            <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
          </table>
        </div>
        <div>
          記事を更新:
          <div>
            id: <input type="number" name="id" min="1" max="5">
          </div>
          <div>
            name: <input type="text" name="name" value="">
          </div>
          <div>
            content: <input type="text" name="content" value="">
          </div>
          <button type="submit">確定</button>
        </div>
        <div>
          記事を削除:
          <div>
            id: <input type="number" name="id" min="1" max="5">
            <input type="hidden" name="id">
          </div>
          <a href="delete.php">サク子</a>
          <button type="submit">削除</button>
        </div>
        </div>
      </form>
    </div>
    <!-- 削除別出 -->
    <div class="">
      <form class="" action="delete.php" method="post">
          id: <input type="number" name="id" min="1" max="5">
          <button type="submit"></button>
      </form>
    </div>

    <div class="">
      <form class="" action="allDelete.php" method="post">
        <h4>スパデリ</h4>
        <button type="submit"></button>
      </form>
    </div>


  </body>
</html>
