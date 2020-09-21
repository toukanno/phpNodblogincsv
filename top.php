<?php
//ログインしたメンバーのみがアクセスできる初期画面
//ここでtext2.csvユーザ情報を編集させる
session_start();
print_r($_SESSION['id']);
print_r($_SESSION['name']);
// // // ログイン済みかを確認
if(!isset($_SESSION['id'])){

  header('Location: login.php');
  exit;
}
// print_r($_SESSOIN['id']);
// print_r($_SESSOIN['name']);
$user = fopen("csv/user.csv","r");
$value = array();
$userid = "";
$name = "";
$password = "";
while($line = fgets($user)) {
  $users = explode(",",$line);
  if($_SESSION['id'] == $users[0]){
    $userid = trim($users[1]);
    $name = trim($users[2]);
    $password = trim($users[3]);
  }
}
fclose($user);




if (!empty($_POST['text'])) {
  $datetime = date('Y-m-d H:m:s');
  $handle = fopen("csv/text.csv", "r");

  while ($line4 = fgets($handle)) {
    $lines4 = explode(",", $line4);
    // print_r($line4);
    $rands[] = $lines4[0];
  }
  fclose($handle);
  // fclose($handle);

  $min = 1;
  $max = 9;
  // $count =1;
  if (empty($tmp)) {
    $tmp = mt_rand($min, $max);
  }
  // $id = 0;

  while (true) {

    // print_r($rands);
    if (!in_array($tmp, $rands)) {
      $id = $tmp;
      // $count++;
      break;
    } elseif (in_array($tmp, $rands)) {
      $tmp = mt_rand($min, $max);
    }
  }
  // print_r($rands);

  $handle = fopen("csv/text.csv", "a");
  // ファイルへ書き込み
  fwrite($handle, $id . "," . $_POST['text'] . ",");
  fwrite($handle, $datetime . "\n");

  fclose($handle);
}
if (!empty($_POST['id'])) {


  $handle = fopen("csv/text.csv", "r");

  $value = array();
  while ($line2 = fgets($handle)) {
    $lines = explode(",", $line2);

    if ($lines[0] != $_POST['id']) {
      var_dump($lines[0]);
      $value[] = $line2;
    }
  }

  fclose($handle);

  $handle = fopen("csv/text.csv", "w");
  foreach ($value as $val) {
    fwrite($handle, $val);
  }

  fclose($handle);
}
if (!empty($_POST['id2']) && !empty($_POST['textchange'])) {
  $id2 = $_POST['id2'];
  $textchange = $_POST['textchange'];
  $datetime2 = date('Y-m-d H:m:s');
  $textcontent = $id2 . "," . $textchange . "," . $datetime2 . "\n";
  print_r($textcontent);

  $handle = fopen("csv/text.csv", "r");
  $value2 = array();
  while ($line3 = fgets($handle)) {
    $lines3 = explode(",", $line3);

    if ($lines3[0] != $id2) {

      $value2[] = $line3;

      var_dump(($lines3[0]));
    } elseif ($lines3[0] == $id2) {

      $value2[$id2] = $textcontent;
    }
  }

  fclose($handle);
  $handle = fopen("csv/text.csv", "w");

  foreach ($value2 as $val) {


    fwrite($handle, $val);
  }

  fclose($handle);
}


function getLoginUser($session_id) {
	$handle = fopen("csv/user.csv", "r");
	while ($line = fgets($handle)) {
		$column = explode(",",$line);
		if($session_id == $column[0]){
			$user["id"] = trim($column[0]);
			$user["login_id"] = trim($column[1]);
			$user["name"] = trim($column[2]);
			//$user["password"] = trim($column[3]);
			return $user;
		}
	}
	return array();
}
$user = getLoginUser($_SESSION['id']);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テキストテーブル</title>
</head>

<body>
  <h1>トップ画面</h1>
  <p><?php echo $_SESSION['name'] ?>さんでログイン中</p>
  <form action="texttable.php" method="post">
    <input type="text" name="text">
    <input type="submit" value="送信">
    <input type="reset">
  </form>
  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="ログアウト">
  </form>
  <form action="edit.php" method="post">
    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    <input type="hidden" name="name" value="<?php echo $name; ?>">
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <input type="submit"  value="ユーザ情報編集">
  </form>

  <?php

  //読み取り専用でファイルを開く
  $handle = fopen("csv/text.csv", "r");
  // $user = fopen("csv/user.csv","r");
  //  テーブルのHTMLを生成
  echo "<table border = 1>
    <tr>
    <th>ID</th>
    <th>名前</th>
    <th>内容</th>
    <th>日付</th>
    <th></th>
    <th></th>
    </tr>";

  //  csvのデータを配列に変換し、HTMLに埋め込んでいる
  //fgetで値を一行ずつ取得する
  
  while ($line = fgets($handle)) {
    // $linesっていう配列にexplodeでカンマ区切りを指定して　$lineを区切って代入する
    // while($line = fgets($user)){
    $lines = explode(",", $line);

    echo "<tr>";
    echo "<td>" . getLoginUser($lines[0])["login_id"] . "</td>";
    echo "<td>" . getLoginUser($lines[0])["name"] . "</td>";
    echo "<td>" . $lines[1] . "</td>";
    echo "<td>" . $lines[2] . "</td>";
    echo '<td>';
    echo '<form action="texttable.php" method="post">';
    echo '<input type="hidden" value = "' . $line[0] . '" name= "id">';
    echo '<input type ="submit" name = "destroy" value = "削除" >';
    echo "</form>";
    echo "</td>";
    echo '<td>';
    echo '<form action="textchange.php" method="post">';
    echo '<input type="hidden" value = "' . $line[0] . '" name= "id">';
    echo '<input type ="submit" name = "change" value = "変更" >';
    echo "</form>";
    echo "</td>";
    echo "</tr>";
  
  }
  echo "</table>";


  // #4 ファイルを閉じる
  fclose($handle);
  ?>


</body>

</html>
