<?php
//ログインしたメンバーのみがアクセスできる初期画面
//ここでtext2.csvユーザ情報を編集させる
session_start();
// // // ログイン済みかを確認
if(!isset($_SESSION['id'])){
	header('Location: login.php');
	exit;
}


function getLoginUser($session_id) {
	$handle = fopen("csv/user.csv", "r");
	while ($line = fgets($handle)) {
		$column = explode(",",$line);
		if($session_id != $column[0]){
			continue;
		}
		$user["id"] = trim($column[0]);
		$user["login_id"] = trim($column[1]);
		$user["name"] = trim($column[2]);
		return $user;
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
  <form action="comment_insert_done.php" method="post">
    <input type="text" name="comment">
    <input type="submit" value="送信">
    <input type="reset">
  </form>
  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="ログアウト">
  </form>
  <form action="edit.php" method="post">
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
  
  // 主キー UPDATE / DELETE用
  $line_number = 0;

  // 自分自身のCSVの内容を表示
  while ($line = fgets($handle)) {
    $line_number++;
    // $linesっていう配列にexplodeでカンマ区切りを指定して　$lineを区切って代入する
    $lines = explode(",", $line);

    // 自分のアカウントの情報以外はスキップ
    $id = $lines[0];
    $login_id = getLoginUser($id)["login_id"];
    $name = getLoginUser($id)["name"];
    $comment = $lines[1];
    $datetime = $lines[2];

    echo "<tr>";
    echo "<td>" . $login_id . "</td>";
    echo "<td>" . $name . "</td>";
    echo "<td>" . $comment . "</td>";
    echo "<td>" . $datetime . "</td>";
    echo '<td>';
    if ($id == $_SESSION["id"]) {
	    echo '<form action="comment_delete_done.php" method="post" onClick="return confirm(\'削除しますか？\');">';
	    echo '  <input type="hidden" value = "' . $line_number . '" name= "line_number">';
	    echo '  <input type ="submit" name = "destroy" value = "削除" >';
	    echo "</form>";
    }
    echo "</td>";
    echo '<td>';
    if ($id == $_SESSION["id"]) {
	    echo '<form action="comment_change.php" method="post">';
	    echo '  <input type="hidden" value = "' . $line_number . '" name= "line_number">';
	    echo '  <input type ="submit" name = "change" value = "変更" >';
	    echo "</form>";
    }
    echo "</td>";
    echo "</tr>";
  
  }
  echo "</table>";


  // #4 ファイルを閉じる
  fclose($handle);
  ?>


</body>

</html>
