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
}
$sql = $dbh->prepare("UPDATE users SET score = 10 WHERE email = ?");
$sql->execute(array($_SESSION["email"]));


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
  $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
  $mail->Port       = 587; // TCPポートを指定（tlsの場合は465や587）

  // 以下ウソの送信
  $mail->Username   = $smtp_username_false;   // SMTPサーバーのユーザ名
  $mail->Password   = $smtp_password;           // SMTPサーバーのパスワード
  // 送受信先設定（第二引数は省略可）
  $mail->setFrom($smtp_username_true, 'お年玉チャレンジ'); // 送信者
  $mail->addAddress($_SESSION["email"]);   // 宛先
  // 送信内容設定
  $mail->isHTML(false);
  $mail->Subject = '【お年玉チャレンジ】賞金確認'; 
  $body = <<<EOF
  チャレンジ成功！！
  以下URLからクリア内容を確認してください。
  {$dummy_url}
  EOF;
  $mail->Body    = $body;  
  // 送信
  $mail->send();
  echo "<div style=\"font-size:30px;padding:1em\">全ステージクリア！<br/>メールを確認してください！<br/></div>";
  sleep(180);
  //以下ホントの送信
  $mail->Username   = $smtp_username_true;   // SMTPサーバーのユーザ名
  $mail->Password   = $smtp_password;           // SMTPサーバーのパスワード
  // 送受信先設定（第二引数は省略可）
  $mail->setFrom('noreply@amazon.com', 'お年玉チャレンジ'); // 送信者
  $mail->addAddress($_SESSION["email"]);   // 宛先
  // 送信内容設定
  $mail->isHTML(false);
  $mail->Subject = '【お年玉チャレンジ】合言葉'; 
  $body = <<<EOF
  チャレンジ成功！！
  送信元が"amazon.com"になっており、迷惑メールに振り分けられているはずですが、こちらが正規のメールです。
  別のダミーが送られています。
  合言葉は「迷惑メール」
  https://kuu13580.com/2023NewYear/check.html
  EOF;
  $mail->Body    = $body;  
  // 送信
  $mail->send();
} catch (Exception $e) {
  // エラーの場合
  echo "ERROR: Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>