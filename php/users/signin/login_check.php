<?php session_start(); ?>

<?php
$local_endpoint = "http://http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/users/signin/";

$env_url = "../../../.env";
// $url = "jsondata.json";
$json = file_get_contents($env_url);
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

  // print"練習\n";
  // $a = 0;
  // while ($a != 3) {
  //   print"
  //   dbhost: $bc_host[$a] <br>
  //   dbname: $bc_name[$a] <br>
  //   dbuser: $bc_user[$a] <br>
  //   dbpass: $bc_pass[$a] <br>
  //   ";
  //   $a++;
  // }
}

$login_name = $_POST['login_name'];
$password = $_POST['login_password'];

if (empty($login_name)||empty($password)) {
  $url = $endpoint.$path.'login.php' ;
  $no = 2;
  header("Location: {$url}?no=".$no);
  exit;
}


$con_str = "host={$bc_host[$debug]} dbname={$bc_name[$debug]} user={$bc_user[$debug]}" ;
# $con_str = "host=localhost dbname=testdb user=test password=test_paSS2";

$conn = pg_connect ($con_str); // ここで処理が止まっている様子

# $hashpwd = password_hash($password, PASSWORD_DEFAULT);

$query = "SELECT * FROM member WHERE login_name=$1";
$result = pg_prepare ($conn, "my_query", $query);

$result = pg_execute ($conn, "my_query", array($login_name));

# check existance in DB
# pg_num_rows 実行結果の行数を返す
if(pg_num_rows($result)==1){
  $row = pg_fetch_assoc($result,0);
  if(password_verify($password,$row['password'])){
    // print "{$row['login_name']}さん<br>ようこそ<br>";
    // print "<a href=\"../../main/top.php\">Topページ</a>へ";
    $_SESSION['login_name'] = $login_name;
    $_SESSION['id'] = $row['id'];
    $_SESSION['site'] = 'kps_hp';

    $url = $staging_endpoint.'php/main/top.php' ;
    header("Location: {$url}");
    exit;
  }else{
    print "パスワードが間違っています<br>";
    print "<a href=\"login.php\">ログインページ</a>へ";
    $url = $endpoint.$path.'login.php' ;
    $no = 5;
    header("Location: {$url}?no=".$no);
    exit;
  }
}else{
  print "ユーザ名は存在しません<br>";
  # $url = $local_endpoint.'php/users/signin/login.php';
  $url = $endpoint.$path.'login.php' ;
  $no = 1;
  header("Location: {$url}?no=".$no);
  exit;
} ?>
