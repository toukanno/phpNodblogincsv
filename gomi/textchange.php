<?php
session_start();
// // // ログイン済みかを確認
if(!isset($_SESSION['id'])){
  header('Location: login.php');
  exit;
}

if (!empty($_POST['line_number'])) {
  $placeholder = "";
  $handle = fopen("csv/text.csv", "r");
  $line_number = 0;
  while ($line = fgets($handle)) {
    // 該当行の取得
    $line_number++;
    if ($line_number != $_POST['line_number']) continue;
    $lines = explode(",", $line);
    $placeholder = $lines[1];
    break;
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
    <input type="hidden" value="change" name="action">
    <input type="hidden" value="<?php echo $id; ?>" name="id2">
    <input type="text" name="textchange" value="<?php echo $placeholder; ?>">
    <input type="submit" value="送信">
    <input type="reset">
  </form>
</body>

</html>
