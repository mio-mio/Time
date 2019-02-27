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

<?php

$d_t = str_replace("T", " ", $_POST['d_t']);
$d_t2 = strtotime($d_t);
$d_t2_d = date("F j, Y, g:i a", $d_t2); //フォーマットを指定
$timezone = $_POST['timezone'];

function show($d_t2_d, $timezone) {
    print $d_t2_d . '(' . $timezone . ')' .'のとき、<br /><br />';
}

function show_result_eng($d_t4,$timezone) {
    
    $d_t4_d = date("F j, Y, g:i a", $d_t4); //$4のフォーマットを指定
    echo $d_t4_d . "($timezone) <br/>";
}

function show_result_jpl($d_t4,$timezone) {
    $timezone_info = "";
    switch($timezone) {
        case "JST":
          $timezone_info = "(JST/東京)";
          break;
        case "GMT":
          $timezone_info = "(GMT/ロンドン)";
          break;
        case "EST":
          $timezone_info = "(EST/アメリカ東海岸)";
          break;
        case "PST":
          $timezone_info = "(PST/アメリカ西海岸)";
          break;
    }
    
    $d_t4_d = date("Y年n月d日 A g:i", $d_t4); //$4のフォーマットを指定
    echo $d_t4_d . "{$timezone_info} <br/>";
    }

function calc_time($d_t3, $user_timezone,$language) {
    
    $timezone_array = array("JST","GMT","EST","PST");
    
    $key = array_search($user_timezone,$timezone_array);
    unset($timezone_array[$key]);
    $timezone_array = array_values($timezone_array);

    $time_diff = "";
    
    for($i=0;$i<count($timezone_array);$i++){
        
        switch($timezone_array[$i]) {
            case "JST":
                $time_diff = "+9";
                break;
            case "GMT":
                $time_diff = "0";
                break;
            case "EST":
                $time_diff = "-5";
                break;
            case "PST":
                $time_diff = "-8";
                break;
        }
            $d_t4 = strtotime(" $time_diff hour", $d_t3);  
            
        if($language == "eng") {
            show_result_eng($d_t4,$timezone_array[$i]);
        } else {
            show_result_jpl($d_t4,$timezone_array[$i]);
        }
       
    }

    
}


//エラー除外

if($d_t ==''){
    print '日時が入力されていません<br />';
}else if($timezone == ''){
    print 'タイムゾーンが入力されていません<br />';
}else{
    show($d_t2_d, $timezone);
    
//計算結果

switch ($timezone) {
case JST:
    $d_t3 = strtotime("-9 hour", $d_t2);  //JST->GMTに戻す
    calc_time($d_t3,$timezone,"eng");
    echo '<br/>日本語では<br/>';
    calc_time($d_t3,$timezone,"jpl");
    break;
case GMT:
    $d_t3 = $d_t2;  //単なる代入
    calc_time($d_t3,$timezone,"eng");
    echo '<br/>日本語では<br/>';
    calc_time($d_t3,$timezone,"jpl");
    break;
case EST:
    $d_t3 = strtotime("+5 hour", $d_t2);  //EST->GMTに戻す
    calc_time($d_t3,$timezone,"eng");
    echo '<br/>日本語では<br/>';
    calc_time($d_t3,$timezone,"jpl");
    break;
case PST:
    $d_t3 = strtotime("+8 hour", $d_t2);  //PST->GMTに戻す
    calc_time($d_t3,$timezone,"eng");
    echo '<br/>日本語では<br/>';
    calc_time($d_t3,$timezone,"jpl");
    break;
}

}

?>
   <button type="button" class="btn-secondary float-right" onclick="history.back()">戻る</button>
   </div>

</div>
<!--- Footer -->
<footer>
    <p class="col-12 fixed-bottom">&copy;2019 kaoru_s  All rights reserved.</p>
</footer>

</body>
</html>