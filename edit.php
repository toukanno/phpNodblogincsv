<?php
$e = "";
$t = "";
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php'); //ログインしていなければログインページへリダイレクト
  exit;
}
// print_r($_SESSION['id']);
// print_r($_SESSION['name']);
$user = fopen("csv/user.csv", "r");
$value = array();
$userid = "";
$name = "";
$password = "";
while ($line = fgets($user)) {
  $users = explode(",", $line);
  if ($_SESSION['id'] == $users[0]) {
    $userid = trim($users[1]);
    $name = trim($users[2]);
    $password = trim($users[3]);
  }
}
print_r($userid);
// print_r($name);
// print_r($password);
// fclose($user);
if (!empty($_POST['userid2']) && !empty($_POST['name2']) && !empty($_POST['password2'])) {
  $id = $_SESSION['id'];
  $userid = $_POST['userid2'];
  $name = $_POST['name2'];
  $password = $_POST['password2'];
  // var_dump($id);
  // var_dump($userid);
  // var_dump($name);
  // var_dump($password);
  // print_r($_POST);
  $user = fopen("csv/user.csv", "r");
  $value = array();
  while ($line = fgets($user)) {
    $lines = explode(",", $line);
    if ($lines[0] != $id && trim($lines[1]) == $userid) {

      print_r($lines[0]);
      $e = "IDがすでに使われています";
      // break;
    }
    if ($lines[0] != $id && trim($line[1]) != $userid) {
      $value[] = $line;
      // print_r($lines[0]);
    }

    if ($lines[0] == $id) {
      // print_r($lines);
      // print_r($value);
      $textcontent = implode(",", array($id, $userid, $name, $password . "\n"));
      // $textcontent =$id.",". $userid.",".$name.",".$password."/n";
      // $n = nl2br('/n');
      $value[] = $textcontent;
    }
  }
  fclose($user);
  print_r($value);

  $handle = fopen("csv/user.csv", "w");

  foreach ($value as $val) {
    fwrite($handle, $val);
  }
  fclose($handle);
  $_SESSION['name'] = $name;
  $t = "内容を編集しました";
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
  <p style="color:red"><?php echo $e; ?></p>
  <p style="color:blue"><?php echo $t; ?></p>
  <form action="edit.php" method="post">
    <p><?php echo $_SESSION['name'] . "さんのユーザ編集画面"; ?></p>
    <lavel>ID</lavel><br>
    <input type="text" name="userid2" value="<?php echo $userid; ?>">
    <br>
    <lavel>名前</lavel>
    </lavel><br>
    <input type="text" name="name2" value="<?php echo $name; ?>">
    <br>
    <lavel>パスワード</lavel><br>
    <input type="password" name="password2" value="<?php echo $password ?>">

    <br><input type="submit" value="編集">
    <br><input type="reset">
  </form>
  <a href="top.php">トップページ</a>
  <a href="delete.php">退会処理</a>