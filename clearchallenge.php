<?php
include "secred_variables.php";
session_start();

if(!isset($_SESSION["email"])){
  echo "ERROR: ログインされていません";
  exit(0);
}
// メールアドレスの存在を確認
include "_connectDB.php";
$sql = $dbh->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
$sql->execute(array($_SESSION["email"]));
if($sql->fetch()[0] == 0) {// メールアドレスが存在しない
  echo "ERROR: メールアドレスが登録されていません。";
  exit(0);
}
$sql = $dbh->prepare("UPDATE users SET score = 10 WHERE email = ?");
$sql->execute(array($_SESSION["email"]));

echo "<div style=\"font-size:30px;padding:1em\">全ステージクリア！</div>";
// $cmd = "nohup php sendClearMail.php ".$_SESSION["email"]." > /dev/null &";
// exec($cmd);

?>