<?php
require_once(dirname(__FILE__).'/db_connect.php');
require_once(dirname(__FILE__).'/crud.php');


function h ($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$results = $pdo->query('select * from crud_db.crud order by id desc');
// $pdo->exec('delete from crud_db.crud where id >=6');


?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1 style="color: skyblue; opacity: 0.5; background-color: gray; text-align: center;">スクラッチらいちゃん</h1>
    <img src="pop.jpg" style="width:40%; height: 20%; object-fit: cover;">

    <!-- 投稿 -->
    <div class="form-container">
      <form method="post">
        <fieldset style="width: 38%;">
          <legend>投稿</legend>
            <div><label>タイトル</label></div>
            <input type="text" name="name" placeholder="山にいってきた">
            <div><label>内容</label></div>
            <textarea name="content" rows="4" cols="30" placeholder="ベニテングダケ食った"></textarea><br>
            <button type="submit" name="たらこ" value="投稿" style="margin-top: 6px; border-radius: 1em;">確定</button>

          <?php if (isset($errors)):?>
            <ul>
          <?php foreach ($errors as $error): ?>
              <li><?=$error?></li>
          <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <?php if (isset($_SESSION['success']) && empty($_POST['name']))
           echo "<p style='color: pink;'>".$_SESSION['success']."</p>"?>
          <?php unset($_SESSION['success'])?>
        </fieldset>
      </form>
    </div>
    <!-- 更新 -->
    <div class="form-container">
      <form class="" action="" method="post">
        <fieldset style="width: 38%;">
        <legend>更新 & 削除</legend>
       <?php if (isset($_SESSION['update']) && empty($_POST['name'])):?>
         <p style="color: skyblue;"><?php echo $_SESSION['update']; ?></p>
       <?php unset($_SESSION['update'])?>
       <?php elseif (isset($_SESSION['delete']) && empty($_POST['name'])): ?>
          <p style="color: green;"><?php echo $_SESSION['delete']; ?></p>
        <?php unset($_SESSION['delete'])?>
       <?php endif; ?>

        <div><label>タイトル</label></div>
          <input type="text" name="name" value="<?php if (isset($row)) echo $row['name'];?>">
          <button type="submit" name="いくら" value="検索">検索</button>
        <?php if (isset($row)): ?>
          <div><label>内容</label></div>
          <textarea name="content" rows="4" cols="30"><?php echo $row['content'];?></textarea><br>
          <button type="submit" name="めんたいこ" value="更新" style="margin-top: 6px; border-radius: 1em;">更新</button>
          <button type="submit" name="かずのこ" value="削除" style="margin-top: 6px; border-radius: 1em;">削除</button>
        <?php endif; ?>
        <?php if(isset($error_message)){echo $error_message;} ?>
      </fieldset>
      </form>
    </div>
    <br>
    <table border style="background-color: pink; opacity: 0.7;">
      <tr>
        <th>タイトル</th><th>内容</th>
      </tr>
      <?php foreach($results->fetchAll(PDO::FETCH_ASSOC) as $row): ?>
        <tr>
          <td><?=h($row['name'])?></td>
          <td><?=h($row['content'])?></td>
        </tr>
      <?php endforeach; ?>
    </table>

  </body>
</html>
