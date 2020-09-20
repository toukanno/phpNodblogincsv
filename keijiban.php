<?php
//var_dump($_POST);
//最初に変数を定義しておかないとエラーになる
$err_msg = "";
$err_msg2 = "";
$message = "";
$datetime = date('Y-m-d H:m:s');
$name = (isset($_POST["name"]) === true) ?$_POST['name']: "";
$comment = (isset($_POST["comment"]) === true) ? trim($_POST["comment"]) :"";

//投稿がある場合のみ処理を行う
if ( isset($_POST["send"]) === true ) {
  if ( $comment === "") $err_msg = "内容を入力してください";
  if($err_msg){
    $fp = fopen("data.txt","a");
    fwrite($fp,$comment.$datetime);
    $message = "書き込みに成功しました。";
  }
}
$fp = fopen("data.txt","r");

$dataArr = array();
while( $res = fgets($fp)){
  $tmp = explode(",",$res);
  $arr = array(
    "comment" => $tmp[0],
    "datetime" => $tmp[1]
  );
  $dataArr[] = $arr;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲示板</title>
</head>
<body>
  <?php echo $message; ?>
  <form method="post" action="">
    内容:<textarea name = "comment" rows="4" cols = "40"><?php echo $comment; ?></textarea>
    <?php echo $err_msg; ?><br>
    <input type="submit" name="send" value="クリック">
  </form>
  <dl>
    <?php foreach($dataArr as $data): ?>
      <p><span><?php echo $data["name"]; ?></span><?php echo $data["comment"]; ?></span></p>
    <?php endforeach; ?>
  </dl>
</body>
</html>