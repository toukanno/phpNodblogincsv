<?php
//ログインするための画面
$e = "";
session_start();
//ログイン済みかを確認
if (isset($_SESSION['id'])) {
  header('Location: top.php'); //ログインしていればtexttable.phpへリダイレクト
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
    $ids[] = trim($users[1]);
    $passwords[] = $users[3];
    // print_r($users[3]);
    // print_r($users[1]);
  }
  fclose($user);

  if (in_array($userid, $ids)) {

    $user = fopen("csv/user.csv", "r");
    while ($line = fgets($user)) {

      $users = explode(",", $line);
      if ($users[1] == $userid && trim($users[3]) == $password) {
        $_SESSION['id'] = $users[0];
        $_SESSION['name'] = trim($users[2]);
        $e = "<a href='top.php' style = 'color:blue'>トップページへ</a>";
        // print_r($users[0]);
        print_r($_SESSION['id']);
        print_r($_SESSION['name']);
        break;
      } else {
        $e = "<a href='login.php' style = 'color:red'>パスワードが違います</a>";
        // break;
      }
    }
    fclose($user);
  } else {
    $e = "<a href='login.php' style = 'color:red'>IDが違います</a>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php echo $e; ?>
  <form action="top.php" method="post">
    <input type="hidden" value="<?php echo $_POST['userid']; ?>" name="name">
    <input type="hidden" value="<?php echo $_POST['name']; ?>" name="mail">
    <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
  </form>
</body>

</html>