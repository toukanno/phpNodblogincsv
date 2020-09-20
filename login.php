<?php
session_start();
if (isset($_SESSION['id'])) {
  header('Location: top.php'); //ログインしていればtop.phpへリダイレクト
  exit;
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

    <div class="login"><a href="signup.php">新規登録はこちらから</a></div>
  </header>
  <main>
    <form action="login_done.php" method="post">
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
          <input type="submit" name='login' class="submit_button" size="35" value="ログイン">
        </div>
      </div>
    </form>
  </main>


</body>

</html>