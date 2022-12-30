<?php
if(!isset($_GET["id"]) || !isset($_GET["p"])){
  echo "ERROR";
  exit(0);
}
$email = urldecode($_GET["id"]);
$password = urldecode($_GET["p"]);

// データベースとの整合確認
include "_connectDB.php";
$sql = $dbh->prepare("SELECT password FROM users WHERE email = ?");
$sql->execute(array($email));
if($sql->fetch()["password"] != $password){
  echo "ERROR:incorrect password";
  exit(0);
}
// セッションスタート
session_start();
session_regenerate_id();
$_SESSION["email"] = $email;
$_SESSION["password"] = $password;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="お年玉チャレンジ">
  <title>お年玉チャレンジ</title>
  <!-- Loading Noto Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet">
  <!-- StyleSheets -->
  <link rel="stylesheet" href="./css/destyle.css">
  <link rel="stylesheet" href="./css/style.css?ver=1.0.0">
  <link rel="stylesheet" href="./css/question0.css?ver=1.0.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/main.js?ver=1.0.0" defer></script>
  <script src="./js/question0.js" defer></script>
</head>
<body>
  <div class="container">
    <div class="tabs">
      <div id="tab1" data-number="1" class="tab selected">第1問</div>
      <div id="tab2" data-number="2" class="tab">第2問</div>
      <div id="tab3" data-number="3" class="tab">第3問</div>
      <div id="tab4" data-number="4" class="tab">第4問</div>
    </div>
    <div class="content">
      <div id="question1" class="selected">
        <div class="question">第一問【情報】<br/>　以下の情報セキュリティに関する記述で誤っている（危険なもの）は？</div>
        <div class="selection"><label><input type="radio" name="radio1">銀行から暗証番号を変更するようメールで誘導されたので電話で確認してから窓口で変更した。</label></div>
        <div class="selection"><label><input type="radio" name="radio1">メールに添付されたURLを確認せずにクリックしてログインした。</label></div>
        <div class="selection"><label><input type="radio" name="radio1">様々なサイトで使用するパスワードはパスワードマネージャなどの管理サービスを使用している。</label></div>
        <div class="selection"><label><input type="radio" name="radio1">コンピュータの挙動が明らかにおかしく、ウィルスに感染したおそれがあるのでLANケーブルを抜いた。</label></div>
      </div>
      <div id="question2" class="not-selected">
        <div class="question">第二問【数学】<br/>　10本に1本あたりのくじを繰り返し戻して引いたとき、10回目までに当たる確率は？</div>
        <div class="selection"><label><input type="radio" name="radio2">約85%</label></div>
        <div class="selection"><label><input type="radio" name="radio2">約65%</label></div>
        <div class="selection"><label><input type="radio" name="radio2">約45%</label></div>
        <div class="selection"><label><input type="radio" name="radio2">約15%</label></div>
      </div>
      <div id="question3" class="not-selected">
        <div class="question">第三問【現代常識】<br/>　Covid-19の"19"の由来と"～株"の名前の付け方とは？</div>
        <div class="selection"><label><input type="radio" name="radio3">2019年に発生しており、ギリシャ文字が株名につけられている</label></div>
        <div class="selection"><label><input type="radio" name="radio3">2019年に発生しており、星の名前が株名につけられている</label></div>
        <div class="selection"><label><input type="radio" name="radio3">19種類目のコロナウィルスであり、ギリシャ文字が株名につけられている</label></div>
        <div class="selection"><label><input type="radio" name="radio3">19種類目のコロナウィルスであり、星の名前が株名につけられている</label></div>
      </div>
      <div id="question4" class="not-selected">
        <div class="question">第四問【】<br/>　</div>
        <div class="selection"><label><input type="radio" name="radio4"></label></div>
        <div class="selection"><label><input type="radio" name="radio4"></label></div>
        <div class="selection"><label><input type="radio" name="radio4"></label></div>
        <div class="selection"><label><input type="radio" name="radio4"></label></div>
      </div>
    </div>
  </div>
</body>
</html>