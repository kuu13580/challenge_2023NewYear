<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/Exception.php');
require('PHPMailer/src/SMTP.php');

mb_language('uni');
mb_internal_encoding('utf-8');

// インスタンスを生成（true指定で例外を有効化）
$mail = new PHPMailer(true);

// 文字エンコードを指定
$mail->CharSet = 'utf-8';

try {
  // デバッグ設定
  // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
  // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

  // SMTPサーバの設定
  $mail->isSMTP();                          // SMTPの使用宣言
  $mail->Host       = 'mail28.conoha.ne.jp';   // SMTPサーバーを指定
  $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
  $mail->Username   = 'noreply@kuu13580.com';   // SMTPサーバーのユーザ名
  $mail->Password   = '*LLaMf9zGaMu*pRrLu@C';           // SMTPサーバーのパスワード
  $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
  $mail->Port       = 465; // TCPポートを指定（tlsの場合は465や587）

  // 送受信先設定（第二引数は省略可）
  $mail->setFrom('noreply@kuu13580.com', '差出人'); // 送信者
  $mail->addAddress('13580kuu@gmail.com', '受信者');   // 宛先
  $mail->addReplyTo('noreply@kuu13580.com', 'お問い合わせ'); // 返信先

  // 送信内容設定
  $mail->Subject = '件名'; 
  $mail->Body    = 'メッセージ本文hakotiras';  

  // 送信
  $mail->send();
  echo "message has sent!";
} catch (Exception $e) {
  // エラーの場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}