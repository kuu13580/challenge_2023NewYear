<?php

if(!isset($_POST["mail-address"]) || !isset($_POST["password"])){
  echo "mail address is incorrect!";
  exit(0);
}
$email = $_POST["mail-address"];
$password = hash("sha256",$_POST["password"]);
// 登録内容をデータベースに追加
include "_connectDB.php";
$sql = $dbh->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
$sql->execute(array($email));
if($sql->fetch()[0] == 1) {// すでに存在する=>更新
  $sql = $dbh->prepare("UPDATE users SET password = ? WHERE email = ?");
  $sql->execute(array($password, $email));
  echo "登録内容を更新しました。<br/>メールを確認してください。";
}else{ //存在しない=>生成
  $sql = $dbh->prepare("INSERT INTO users(email, password) VALUE (?, ?)");
  $sql->execute(array($email, $password));
  echo "新規に登録しました。<br/>メールを確認してください。";
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// 設置した場所のパスを指定する
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/language/phpmailer.lang-ja.php';

mb_language('uni');
mb_internal_encoding('utf-8');

// インスタンスを生成（true指定で例外を有効化）
$mail = new PHPMailer(true);

// 文字エンコードを指定
$mail->CharSet = 'utf-8';
$mail->setLanguage('ja', 'language/');
try {
  // デバッグ設定
  // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
  // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

  // SMTPサーバの設定
  $mail->isSMTP();                          // SMTPの使用宣言
  $mail->Host       = $smtp_server;   // SMTPサーバーを指定
  $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
  $mail->Username   = $smtp_username_true;   // SMTPサーバーのユーザ名
  $mail->Password   = $smtp_password;           // SMTPサーバーのパスワード
  $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
  $mail->Port       = 587; // TCPポートを指定（tlsの場合は465や587）
  // 送受信先設定（第二引数は省略可）
  $mail->setFrom($smtp_username_true, 'お年玉チャレンジ'); // 送信者
  $mail->addAddress($email);   // 宛先
  // 送信内容設定
  $mail->isHTML(false);
  $mail->Subject = '【お年玉チャレンジ】'; 
  $url_email = urlencode($email);
  $url_password = urlencode($password);
  $body = <<<EOF
  こちらのメールアドレスが通知用メールアドレスです。
  クリアの際に確認用の合言葉を送ります。
  下記URLから挑戦してください。
  https://kuu13580.com/2023NewYear/mystery.php?id={$url_email}&p={$url_password}
  EOF;
  $mail->Body    = $body;  
  // 送信
  $mail->send();
} catch (Exception $e) {
  // エラーの場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>