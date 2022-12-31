<?php
if(!isset($_POST["mail-address"]) || !isset($_POST["password"]) || !isset($_POST["secred-word"])){
  echo "ERROR: POST Data is incorrect!";
  exit(0);
}
$email = $_POST["mail-address"];
$password = hash("sha256",$_POST["password"]);
$secred_word = $_POST["secred-word"];
// 合言葉があっていたらデータベースを変更
// メールとパスワード照合
include "_connectDB.php";
$sql = $dbh->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND password = ?");
$sql->execute(array($email, $password));
if($sql->fetch()[0] == 1) {// 存在しない
  echo "<div style=\"font-size:30px;padding:1em\">メールアドレスかパスワードが間違っています。<br/>戻ってもう一度入力してください。</div>";
}
if($secred_word == "迷惑メール"){
  $sql = $dbh->prepare("UPDATE users SET score = 1000 WHERE email = ?");
  $sql->execute(array($email));
  echo "<div style=\"font-size:30px;padding:1em\">お年玉ゲット！！<br/>結果発表をお待ちください。</div>";
}
echo "<div style=\"font-size:30px;padding:1em\">合言葉が間違っています。もう一度チャレンジしよう！</div>";

?>