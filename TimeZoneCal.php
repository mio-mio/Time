<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content=“IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>タイムゾーン変換＆コピペアプリ</title>
    <script src="js/jquery.waypoints.min.js" type="text/javascript"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="watch.ico">
 </head>
<body>

<div class="wrapper row wrapper-bg">

    <div class="intro col-12">
        <h1>タイムゾーン変換＆コピペアプリ</h1>
        <p>このアプリは、世界を股にかけて仕事や恋愛をする方、大切な人の到着を待ちわびる方々のために制作しました。</p>
    </div>

<!-- ここから本体 -->
    <div class="container container-custom mx-auto padding ">
    <p>特定の時間が日本・イギリス・アメリカで何時なのかを知りたい場合は、以下に入力ください。</p>
    <form method="post" action="cal.php">
    <label>基準日時:
    <input type="datetime-local" name="d_t">
    
    <select name="timezone">
    <option value="">選択してください</option>
    <option value="JST">東京（JST)</option>
    <option value="GMT">ロンドン(GMT)</option>
    <option value="EST">アメリカ東海岸(EST)</option>
    <option value="PST">アメリカ西海岸(PST)</option>
    </select> 
    <input type="submit" class="btn-secondary" value="調べる" >
    </form>
<hr>

なお、現在時刻は、

<div role="tabpanel text-center">
<div class="tab-content">
  <div class="tab-pane active" id="lang-en" role="tabpanel" aria-labelledby="lang-en">

<?php
echo "<br />";

date_default_timezone_set('Asia/Tokyo');
$time_tokyo = date("l, M j, Y, g:ia T");
print($time_tokyo);
echo "<br />";

$date_now  = new DateTime($time_tokyo, new DateTimeZone('Asia/Tokyo'));
$date_now ->setTimezone(new DateTimeZone('Europe/London'));
echo $date_now ->format('l, M j, Y, g:ia T') . "\n";
echo "<br />";
$date_now ->setTimezone(new DateTimeZone('America/New_York'));
echo $date_now ->format('l, M j, Y, g:ia T') . "\n";
echo "<br />";

$date_now ->setTimezone(new DateTimeZone('America/Los_Angeles'));
echo $date_now ->format('l, M j, Y, g:ia T') . "\n";
echo "<br />";


?>

</div>

<div class="tab-pane" id="lang-jpl" role="tabpanel" aria-labelledby="lang-jpl">


<?php
echo "<br />";

$date_now  = new DateTime($time_tokyo, new DateTimeZone('Asia/Tokyo'));
echo '日本時間：' . $date_now ->format('Y年n月d日 g:ia');
echo "<br />";

$date_now ->setTimezone(new DateTimeZone('Europe/London'));
echo 'ロンドンでは：';
echo $date_now ->format('Y年n月d日 g:ia T');
echo "<br />";

$date_now ->setTimezone(new DateTimeZone('America/New_York'));
echo 'アメリカ東海岸では：';
echo $date_now ->format('Y年n月d日 g:ia T');
echo "<br />";


$date_now ->setTimezone(new DateTimeZone('America/Los_Angeles'));
echo 'アメリカ西海岸では：';
echo $date_now ->format('Y年n月d日 g:ia T');
echo "<br />";


?>
    </div> <!--tab の閉じタグ-->

<ul class="nav nav-tabs float-right">
  <li class="nav-item">
  <a class="nav-link  btn-secondary" id="home-tab" data-toggle="tab" href="#lang-en" role="tab">English</a>
  </li>
  <li class="nav-item">
  <a class="nav-link btn-secondary" id="profile-tab" data-toggle="tab" href="#lang-jpl" role="tab">日本語</a>
  </li>
</ul>
 </div>
</div>

    </div>

</div>
<!--- Footer -->
<footer>
    <p class="col-12 fixed-bottom">&copy;2019 kaoru_s  All rights reserved.</p>
</footer>

</body>

</html>