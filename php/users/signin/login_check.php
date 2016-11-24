<?php

$url = "../../../.env";
// $url = "jsondata.json";
$json = file_get_contents($url);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,true);
$debug = 0;

if ($arr === NULL) {
  print"null";
        return;
}else{
  $json_count = count($arr["env"]["database"]);
  $bc_name = array();
  $bc_user = array();
  $bc_pass = array();
  for($i=$json_count-1;$i>=0;$i--){
      $bc_host[] = $arr["env"]["database"][$i]["host"];
      $bc_name[] = $arr["env"]["database"][$i]["name"];
      $bc_user[] = $arr["env"]["database"][$i]["user"];
      $bc_pass[] = $arr["env"]["database"][$i]["pass"];
  }

  print"練習\n";
  $a = 0;
  while ($a != 2) {
    print"
    dbhost: $bc_host[$a] <br>
    dbname: $bc_name[$a] <br>
    dbuser: $bc_user[$a] <br>
    dbpass: $bc_pass[$a] <br>
    ";
    $a++;
  }
}

$login_name = $_POST['input_id'];
$password = $_POST['password'];

$link = mysql_connect($bc_host[$debug], $bc_user[$debug], $bc_pass[$debug]);
if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}
print "success";
mysql_close($link);

$con_str = "host={$bc_host[$debug]} dbname={$bc_name[$debug]} user={$bc_user[$debug]} password=$bc_pass[$debug]" ;
# $con_str = "host=localhost dbname=testdb user=test password=test_paSS2";
print "hello";
print "$con_str";
$conn = pg_connect ($con_str);

# $hashpwd = password_hash($password, PASSWORD_DEFAULT);

$query = "SELECT * FROM member WHERE login_name=$1";
$result = pg_prepare ($conn, "my_query", $query);

$result = pg_execute ($conn, "my_query", array($login_name));

# check existance in DB
# pg_num_rows 実行結果の行数を返す
if(pg_num_rows($result)==1){
  $row = pg_fetch_assoc($result,0);
  if(password_verify($password,$row['password'])){
    print "{$row['login_name']}さん<br>ようこそ<br>";
    print "<a href=\"../../main/top.php\">Topページ</a>へ";
  }else{
    print "パスワードが間違っています<br>";
    print "<a href=\"login.php\">ログインページ</a>へ";
  }
}else{
  print "ユーザ名は存在しません<br>";
  print "<a href=\"login.php\">ログインページ</a>へ<br>";
  print "<a href=\"../signup/input.php\">ユーザ登録ページ</a>へ";
} ?>
