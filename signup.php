<?php
session_start();
$e = "";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>内容確認</title>
</head>

<body>
  <form action="signup_done.php" method="post">
    <p style="color:red"><?php echo $e ?></p>
    <lavel>USERID</lavel><br>
    <input type="text" name="userid">
    <br>
    <lavel>名前</lavel>
    </lavel><br>
    <input type="text" name="name">
    <br>
    <lavel>パスワード</lavel><br>
    <input type="password" name="password">

    <br><input type="submit" value="登録">
    <br><input type="reset">
  </form>
  <a href="login.php">IDをお持ちの方はこちらから</a>
</body>

</html>