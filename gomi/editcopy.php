<?php
session_start();
if (!empty($_POST['userid']) && !empty($_POST['name']) && !empty($_POST['password'])) {

  $user = fopen("csv/user.csv", "a");

  foreach ($value8 as $val) {
    fwrite($user, $val);
  }
  $_SESSION['userid'] = $userid;
  $_SESSION['name'] = $name;
  $_SESSION['password'] = $password;
  echo "登録が完了しました";
  // header('Location:register.php');
  fclose($user);
}

?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テキストテーブル</title>
</head>

<body>
  <form action="editcopy.php" method="post">
    <p style="color: red;"><?php echo $error_message2; ?></p>
    <p><?php echo $_SESSION['name'] . "さんのユーザ編集画面"; ?></p>
    <lavel>ID</lavel><br>
    <input type="text" name="userid">
    <br>
    <lavel>名前</lavel>
    </lavel><br>
    <input type="text" name="name">
    <br>
    <lavel>パスワード</lavel><br>
    <input type="password" name="password">

    <br><input type="submit" value="編集" name="edit">
    <br><input type="reset">
  </form>