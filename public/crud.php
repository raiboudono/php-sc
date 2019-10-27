<?php
require_once('db_connect.php');

session_start();

try {
//ここで isset($_POST['たらこ']) しておけば、なぜか更新時の if でisset しなくても notice にならない
//おそらく post 時に プログラムの順次実行により、この if が評価されているのだろう
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['たらこ']) && $_POST['たらこ'] == '投稿') {

    if (!isset($_POST['name']) || $_POST['name'] == '')
    $errors[] = "おい、タイトル";
    if (!isset($_POST['content']) || $_POST['content'] == '')
    $errors[] = "おい、内容";

    if (empty($errors)) {

      $stmt = $pdo->prepare('insert into crud_db.crud (name, content) values(:name, :content)');
      $stmt->bindValue('name', $_POST['name']);
      $stmt->bindValue('content', $_POST['content']);
      $stmt->execute();
      // error_log(print_r($_POST, true),"3","C:\Users\ysann\Desktop\my-application\php-sc\public\debug.log");
      $_SESSION['success'] = "投稿完了";

      header('Location: /');
      exit;
    }
  } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['いくら'] == "検索") {

    if (!isset($_POST['name']) || $_POST['name'] == '') {
      $error_message = "タイトルねーやん";
    } else {
      $stmt = $pdo->prepare('select name, content from crud_db.crud where name = :name');
      $stmt->bindValue('name', $_POST['name']);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $_SESSION['name'] = $row['name'];
    }
  } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['めんたいこ'] == "更新") {

    if (!isset($_POST['name']) || $_POST['name'] == '')
    $errors[] = "おい、タイトル";
    if (!isset($_POST['content']) || $_POST['content'] == '')
    $errors[] = "おい、内容";

    if (empty($errors)) {

      $stmt = $pdo->prepare('update crud_db.crud set name=:new_name, content=:new_content where name=:name');
      $stmt->bindValue('new_name', $_POST['name']);
      $stmt->bindValue('new_content', $_POST['content']);
      $stmt->bindValue('name', $_SESSION['name']);
      $stmt->execute();
      // error_log(print_r($_POST, true),"3","C:\Users\ysann\Desktop\my-application\php-sc\public\debug.log");
      $_SESSION['update'] = "更新完了";

      header('Location: /');
      exit;
    }
  } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['かずのこ'] == "削除") {
    if (!isset($_POST['name']) || $_POST['name'] == '');
    if (!isset($_POST['content']) || $_POST['content'] == '');
    $stmt = $pdo->prepare('delete from crud_db.crud where name = :name');
    $stmt->bindValue('name', $_POST['name']);
    $stmt->execute();

    $_SESSION['delete'] = "削除完了";

    header('Location: /');
    exit;
  }

} catch (PDOException $e) {
  exit($e->getMessage());
}
