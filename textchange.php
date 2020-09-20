<?php
session_start();
print_r($_SESSION['id']);
print_r($_SESSION['name']);
// // // ログイン済みかを確認
if(!isset($_SESSION['id'])){

  header('Location: login.php');
  exit;
}
if (!empty($_POST['id'])) {
  $id = $_POST['id'];
  $placeholder = "";
  $handle = fopen("csv/text.csv", "r");
  while ($line = fgets($handle)) {
    $lines = explode(",", $line);

    if ($lines[0] == $_POST['id']) {
      $placeholder = $lines[1];
    }
  }
  fclose($handle);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>内容変更</title>
</head>
<?php


?>

<body>
  <form action="texttable.php" method="post">
    <input type="hidden" value="<?php echo $id; ?>" name="id2">
    <input type="text" name="textchange" value="<?php echo $placeholder; ?>">
    <input type="submit" value="送信">
    <input type="reset">
  </form>
</body>

</html>