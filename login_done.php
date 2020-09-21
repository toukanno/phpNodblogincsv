<?php
//ログインするための画面
$e = "";
session_start();

//ログイン済みかを確認
if (isset($_SESSION['id'])) {
	header('Location: top.php'); //ログインしていればtexttable.phpへリダイレクト
	exit;
}

//ログイン機能 認証
if (!empty($_POST['userid']) && !empty($_POST['password'])) {
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$user = fopen("csv/user.csv", "r");
	while ($line = fgets($user)) {
		$users = explode(",", $line);
		$ids[] = trim($users[1]);
		$passwords[] = $users[3];
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
				break;
			} else {
				// パスワードが違います
				$e = "<a href='login.php' style = 'color:red'>ログイン失敗</a>";
			}
		}
		fclose($user);
	} else {
		// IDが違います
		$e = "<a href='login.php' style = 'color:red'>ログイン失敗</a>";
	}
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="1;URL=top.php">
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
