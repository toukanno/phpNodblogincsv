<?php
session_start();
$t = "";
// if (!isset($_SESSION['id'])) {
//   header('Location: login.php');
//   exit;
// }
if (!isset($_POST['destroy'])) {
  $user = fopen("csv/user.csv", "r");
  $value = array();
  $value2 = array();
  while ($line = fgets($user)) {
    $users = explode(",", $line);
    if ($_SESSION['id'] != $users[0]) {
      $value[] = $line;
      // break;
    } else {
      $value2[] = $line;
    }
    print_r($value);
  }
  fclose($user);
  $user = fopen("csv/user.csv", "w");
  foreach ($value as $val) {
    fwrite($user, $val);
  }
  fclose($user);
  $t = "アカウントを削除しました";
  session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <p style="color:blue"><?php echo $t; ?></p>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント退会処理</title>
</head>

<body>
  <form action="delete_done.php" method="post">
    <input type="submit" value="退会" name='destroy'>
  </form>
</body>

</html>
<a href="top.php">トップページ</a>