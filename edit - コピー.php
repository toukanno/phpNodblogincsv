<?php
session_start();
// var_dump($_SESSION['id']);
// var_dump($_SESSION['name']);
// var_dump($_SESSION['password']);
// if(isset($_POST['edit']) === true)
if (!empty($_POST['id']) || !empty(!empty($_POST['name'])) || !empty($_POST['password'])) {
  $userid = $_POST['id'];
  $name = $_POST['name'];
  $password = $_POST['password'];
  $user = fopen("csv/user.csv", "r");
  while ($line = fgets($user)) {
    $lines = explode(",", $line);
    //ここにIDを入れていく
    $ids[] = $lines[1];
  }
  fclose($user);
  print_r($ids);
  if (!empty($_POST['id']) && empty($_POST['name']) && empty($_POST['password'])) {
    $userid = $_POST['id'];
    print_r($userid);
    if (!in_array($userid, $ids)) {
      
      $user = fopen("csv/user.csv", "r");
      $value2 = array();
      while ($line2 = fgets($user)) {
        $lines2 = explode(",", $line2);
        var_dump($_SESSSON['id']);
        print_r($value2); //値がとれていないなので書き込めない
        if ($_SESSSON['id'] != $lines2[1]) {
          $value2[] = $line2;
          var_dump($lines2[1]);
        } elseif ($lines2[1] == $_SESSSON['id']) {
          // $textcontent =  $lines[0].",".$userid . "," . $lines2[2] . "," . $lines2[3] . "\n";
          $textcontent = implode(",", array($lines2[0], $userid, $lines2[2], $lines2[3], "\n"));
          $value2[] = $textcontent;
        }
      }

      print_r($value2); //値が取れていない
      fclose($user);
      $user = fopen("csv/user.csv", "w");

      foreach ($value2 as $val) {
        fwrite($user, $val);
      }
      $_SESSION['userid'] = $userid;
      // $_SESSION['name'] = $tmp2;
      // $_SESSION['password'] = $tmp3;
      echo "登録が完了しました";
      // header('Location:register.php');
      fclose($user);
    } else {
      $error_message2 = 'IDがすでに使われています';
      exit();
    }
  } elseif (!empty($_POST['id']) && !empty($_POST['name']) && empty($_POST['password'])) {
    if (!in_array($userid, $ids)) {
      $user = fopen("csv/user.csv", "r");
      $value3 = array();
      while ($line3 = fgets($user)) {
        $lines3 = explode(",", $line3);
        if ($_SESSION['id'] != $lines3[1]) {
          $value3[] = $line3;
        } elseif ($lines3[1] == $_SESSION['id']) {
          // $textcontent = $userid . "," . $name . "," . $lines[2] . "\n";
          $textcontent = implode(",", array($lines3[0], $userid, $name, $lines3[3], "\n"));
          $value3[] = $textcontent;
        }
      }
      fclose($user);
      $user = fopen("csv/user.csv", "w");
      foreach ($value3 as $val) {
        fwrite($user, $val);
      }
      fclose($user);
      echo "登録が完了しました";
      $_SESSION['userid'] = $userid;
      $_SESSION['name'] = $name;
    } else {
      $error_message2 = 'IDがすでに使われています';
      exit();
    }
  } elseif (!empty($_POST['id']) && empty($_POST['name']) && !empty($_POST['password'])) {
    //TODOここで変数に入れたほうがいいかも
    if (!in_array($userid, $ids)) {
      $user = fopen("csv/user.csv", "r");
      $value4 = array();
      while ($line4 = fgets($user)) {
        $lines4 = explode(",", $line4);
        if ($_SESSION['id'] != $line4[1]) {
          $value4[] = $line4;
        } elseif ($lines4[1] == $_SESSION['id']) {
          // $textcontent = $userid . "," . $lines[1] . "," . $password;
          $textcontent = implode(",", array($lines4[0], $userid, $lines4[2], $password, "\n"));
          $value3[] = $textcontent;
        }
      }
      fclose($user);
      $user = fopen("csv/user.csv", "w");
      foreach ($value4 as $val) {
        fwrite($user, $val);
      }
      fclose($user);
      echo "登録が完了しました";
      $_SESSION['userid'] = $userid;
      $_SESSION['password'] = $password;
    } else {
      $error_message2 = "IDがすでに使われています";
      exit();
    }
  } elseif (empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['password'])) {
    $user = fopen("csv/user.csv", "r");
    $value5 = array();
    while ($line5 = fgets($user)) {
      $lines5 = explode(",", $line5);
      if ($_SESSION['id'] != $lines5[1]) {
        $value5[] = $line5;
      } elseif ($lines5[1] == $_SESSION['id']) {
        // $textcontent = $lines5[1] . "," . $name . "," . $password;
        $textcontent = implode(",", array($lines5[0], $lines5[1], $name, $password, "\n"));
        $value5[] = $textcontent;
      }
    }
    fclose($user);
    $user = fopen("csv/user.csv", "w");
    foreach ($value5 as $val) {
      fwrite($user, $val);
    }
    fclose($user);
    echo "内容を編集しました";
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
  } elseif (empty($_POST['id']) && !empty($_POST['name']) && empty($_POST['password'])) {
    $user = fopen("csv/user.csv", "r");
    $value6 = array();
    while ($line6 = fgets($user)) {
      $lines6 = explode(",", $line6);
      if ($_SESSION['id'] != $lines6[1]) {
        $value6[] = $line6;
      } elseif ($lines6[1] == $_SESSION['id']) {
        // $textcontent = $lines5[1] . "," . $name . "," . $lines5[2];
        $textcontent = implode(",", array($lines6[0], $lines6[1], $name, $lines6[3], "\n"));
        $value6[] = $textcontent;
      }
    }
    fclose($user);
    $user = fopen("csv/user.csv", "w");
    foreach ($value5 as $val) {
      fwrite($user, $val);
    }
    fclose($user);
    echo "内容を編集しました";
    $_SESSION['name'] = $name;
  } elseif (empty($_POST['id']) && empty($_POST['name']) && !empty($_POST['password'])) {
    $user = fopen("csv/user.csv", "r");
    $value7 = array();
    while ($line7 = fgets($user)) {
      $lines7 = explode(",", $line7);
      if ($_SESSION['id'] != $lines7[1]) {
        $value7[] = $line7;
      } elseif ($lines7[1] == $_SESSION['id']) {
        // $textcontent = $lines7[1] . "," . $lines7[1] . "," . $password;
        // $textcontent = $lines7[1] . "," . $lines7[1] . "," . $password;
        $textcontent = implode(",", array($lines7[0], $lines7[1], $lines7[2], $password, "\n"));
        $value7[] = $textcontent;
      }
    }
    fclose($user);
    $user = fopen("csv/user.csv", "w");
    foreach ($value7 as $val) {
      fwrite($user, $val);
    }
    fclose($user);
    fclose($user);
    echo "内容を編集しました";
    $_SESSION['password'] = $password;
  } elseif (!empty($_POST['id']) && empty($_POST['name']) && empty($_POST['password'])) {
    if (!in_array($userid, $ids)) {
      $user = fopen("csv/user.csv", "r");
      $value8 = array();
      while ($line8 = fgets($user)) {
        $lines8 = explode(",", $line2);
        var_dump($_SESSSON['id']);
        print_r($value8); //値がとれていないなので書き込めない
        if ($_SESSSON['id'] != $lines8[1]) {
          $value8[] = $line2;
          var_dump($lines2[1]);
        } elseif ($lines2[1] == $_SESSSON['id']) {
          // $textcontent =  $lines[0].",".$userid . "," . $lines2[2] . "," . $lines2[3] . "\n";
          $textcontent = implode(",", array($lines8[0], $userid, $name, $password, "\n"));
          $value8[] = $textcontent;
        }
      }

      print_r($value8); //値が取れていない
      fclose($user);
      $user = fopen("csv/user.csv", "w");

      foreach ($value8 as $val) {
        fwrite($user, $val);
      }
      $_SESSION['userid'] = $userid;
      $_SESSION['name'] = $name;
      $_SESSION['password'] = $password;
      echo "登録が完了しました";
      // header('Location:register.php');
      fclose($user);
    } else {
      $error_message2 = 'IDがすでに使われています';
      exit();
    }
  }
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
  <form action="editcopy.php" method="post">
    <p style="color: red;"><?php echo $error_message2; ?></p>
    <p><?php echo $_SESSION['name'] . "さんのユーザ編集画面"; ?></p>
    <lavel>ID</lavel><br>
    <input type="text" name="userid" value="<?php echo $_SESSION['id'] ?>">
    <br>
    <lavel>名前</lavel>
    </lavel><br>
    <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>">
    <br>
    <lavel>パスワード</lavel><br>
    <input type="password" name="password" value="<?php echo $_SESSION['password'] ?>">

    <br><input type="submit" value="編集" name="edit">
    <br><input type="reset">
  </form>