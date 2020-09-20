<?php
$e = "";
$t1 = "";
$t2 = "";
//ログインしてない人向け画面
session_start();
// if(isset($_SESSION['id'])){
//   header('Location: top.php');//ログインしていればtexttable.phpへリダイレクト
//   exit;
// }



if (!empty($_POST['userid']) && !empty($_POST['name']) && !empty($_POST['password'])) {
  $userid = $_POST['userid'];
  $name = $_POST['name'];
  $password = $_POST['password'];
  $user = fopen("csv/user.csv", "r");
  while ($line = fgets($user)) {
    $users = explode(",", $line);
    $ids[] = trim($users[1]);
  }
  fclose($user);
  if (!in_array($userid, $ids)) {

    $id = file("csv/id.csv");
    $id[0] += 1;
    // fwrite()
    print_r($id);
    $idscsv = fopen("csv/ids.csv","a");
    fwrite($idscsv,$id[0]."\n");
    fclose($idscsv);
    // $user = fopen("csv/user.csv", "a");
    $user = fopen("csv/user.csv", "r");
    $value = array();
    while ($line = fgets($user)) {
      $lines = explode(",", $line);
      $value[] = $line;
    }
    // fwrite($user,$id[0].",". $userid . "," . $name . "," . $password . "\n");
    $textcontent = implode(",", array($id[0], $userid, $name, $password. "\n"));
    $value[] = $textcontent;
    $user = fopen("csv/user.csv", "w");
    foreach ($value as $val) {
      fwrite($user, $val);
    }
    fclose($user);
    $intid = fopen("csv/id.csv", "w");
    fwrite($intid, $id[0]);
    fclose($intid);
    $user = fopen("csv/user.csv", "r");
    while ($line = fgets($user)) {
      $users = explode(",", $line);
      if ($users[1] == $userid && trim($users[3]) == $password) {
        $_SESSION['id'] = $users[0];
        $_SESSION['name'] = trim($users[2]);
        $t1 = "登録が完了しました。";
        $t2 = "<a href='top.php' style = 'color:blue'>トップページへ</a>";
        // exit();
      }
    }
  } else {
      
    $e = "IDがすでに使われています";
    // exit();
  }
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="register_confirm.css">
</head>

<body>

  <header>
    <h1 style="color: red;"><?php echo $e ?></h1>
    <p style = 'color:blue'><?php echo $t1 ?></ｐ>
    <?php echo $t2 ?>
  </header>

  <main>
    <div class="confirm">
      <div class="form_contents">
        <h2>会員登録 確認</h2>
        <p>こちらの内容で登録しても宜しいでしょうか？</p>
        <div class="name">
          ユーザID :
          <?php echo $_POST['userid']; ?>
        </div>
        <div class="name">
          名前 :
          <?php echo $_POST['name']; ?>
        </div>
        <div class="password">
          パスワード :
          <?php echo $_POST['password']; ?>
        </div>
        <div class="buttons">
          <div class="modoru_button">
            <a href="signup.php">戻って修正する</a>
          </div>
          <div class="submit">
            <form action="top.php" method="post">
              <input type="hidden" value="<?php echo $_POST['userid']; ?>" name="name">
              <input type="hidden" value="<?php echo $_POST['name']; ?>" name="mail">
              <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
              <input type="submit" class="submit_button" size="35" value="登録する">
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer>
  </footer>

</body>

</html>