<?php
//ログインするための画面
$e = "";
session_start();
//ログイン済みかを確認
if(isset($_SESSION['id'])){
  header('Location: top.php');//ログインしていればtexttable.phpへリダイレクト
  exit;
}
//ログイン機能



if (!empty($_POST['userid']) && !empty($_POST['password'])) {
  // print_r($_POST);
  // print_r($_SESSION);
  $userid = $_POST['userid'];
  $password = $_POST['password'];
  $user = fopen("csv/user.csv", "r");
  while ($line = fgets($user)) {
      $users = explode(",", $line);
      if (trim($users[1]) == $userid && trim($users[3]) == $password) {
        // 　print_r($users[0]);
          $_SESSION['id'] = trim($users[0]);
          $_SESSION['name'] = trim($users[2]);
          echo "<a href='top.php' style = 'color:blue'>トップページへ</a>";
          print_r($users[0]);
          exit;
      }else{
        echo "<a href='login.php' style = 'color:red'>IDかパスワードが違います</a>";
        exit;
      }
    }
    fclose($user);
  }


?>





<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>

</head>

<body>
  <header>
    <p style="color: red;"><?php echo $e; ?></p>
    <div class="login"><a href="signup.php">新規登録はこちらから</a></div>
  </header>
  <main>
    <form action="login.php" method="post">
      <div class="form_contents">
        <h2>ログイン</h2>
        
        <div class="userid">
          <div class="hissu">必須</div>
          <lavel>ID</lavel><br>
          <input type="text" class="formbox" size="40" name="userid" required>
        </div>
        <div class="password">
          <div class="hissu">必須</div><label>パスワード</label><br>
          <input type="password" class="formbox" size="40" name="password" id="password" required>
        </div>
        <div class="login">
          <input type="submit" name = 'login' class="submit_button" size="35" value="ログイン">
        </div>
      </div>
    </form>
  </main>



</body>

</html>