<?php
require_once("func/header.php");

$e = "";
$t1 = "";
$t2 = "";
//ログインしてない人向け画面
session_start();

if (!empty($_POST['userid']) && !empty($_POST['name']) && !empty($_POST['password'])) {
	$userid = $_POST['userid'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$user = fopen("csv/user.csv", "r");
	while ($line = fgets($user)) {
		$users = explode(",", $line);
		$ids[] = trim($users[1]);
	}
	fclose($user);
	if (!in_array($userid, $ids)) {

		$id = file("csv/id.csv");
		$id[0] += 1;
		// fwrite()
		print_r($id);
		$idscsv = fopen("csv/ids.csv","a");
		fwrite($idscsv,$id[0]."\n");
		fclose($idscsv);
		// $user = fopen("csv/user.csv", "a");
		$user = fopen("csv/user.csv", "r");
		$value = array();
		while ($line = fgets($user)) {
			$lines = explode(",", $line);
			$value[] = $line;
		}
		// fwrite($user,$id[0].",". $userid . "," . $name . "," . $password . "\n");
		$textcontent = implode(",", array($id[0], $userid, $name, $password. "\n"));
		$value[] = $textcontent;
		$user = fopen("csv/user.csv", "w");
		foreach ($value as $val) {
			fwrite($user, $val);
		}
		fclose($user);
		$intid = fopen("csv/id.csv", "w");
		fwrite($intid, $id[0]);
		fclose($intid);
		$user = fopen("csv/user.csv", "r");
		while ($line = fgets($user)) {
			$users = explode(",", $line);
			if ($users[1] == $userid && trim($users[3]) == $password) {
				$_SESSION['id'] = $users[0];
				$_SESSION['name'] = trim($users[2]);
				$t1 = "登録が完了しました。";
				$t2 = "<a href='top.php' style = 'color:blue'>トップページへ</a>";
			}
		}
	} else {
		$e = "IDがすでに使われています。";
		$e.= '<script> setTimeout("window.history.back()", 2000); </script>';
	}
}


?>
<title>会員登録</title>
<body>

	<?php if ($e) { ?>
	<div class="alert alert-danger" role="alert"><?php echo $e; ?></div>
	<?php } ?>

	<?php if ($t1) { ?>
	<div class="alert alert-primary" role="alert"><?php echo $t1; ?></div>
	<?php } ?>

	<?php if ($t2) { ?>
	<div class="alert alert-primary" role="alert"><?php echo $t2; ?></div>
	<?php } ?>

	<?php if ($e == "") { ?>
	<h2>会員登録 確認</h2>
	<p>以下内容で登録しました。</p>
	<div> ユーザID : <?php echo $_POST['userid']; ?> </div>
	<div> 名前 : <?php echo $_POST['name']; ?> </div>
	<div> パスワード : <?php echo $_POST['password']; ?> </div>
	<?php } ?>
