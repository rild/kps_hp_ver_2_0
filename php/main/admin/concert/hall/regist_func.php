<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>リダイレクト : 演奏会会場を登録しています</title>
</head>

<body>
<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/hall/";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
);

if (!isset($_POST['hall_id']) || !isset($_POST['hall_name'])) {
  // link directly
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["link_directly"];
  header("Location: {$url}?sidebar=5&no=".$no);
  exit;
}

// http://php.net/manual/ja/function.compact.php PHP array に変数を入れる

$hall_id = $_POST['hall_id'];
$hall_name = $_POST['hall_name'];
$hall_address = $_POST['hall_address'];

$db_conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=5&no=".$no);
  exit;
}

// // <---------- 重複のチェック
$check_qu = pg_query($db_conn, "SELECT hall_id FROM kps_hall");
$check_flag = 0;
  while ($data = pg_fetch_object($check_qu)) {
    if ($data->hall_id == $hall_id) $check_flag = -1;
  }
  if ($check_flag < 0) {
    // IDが重複している
    $url = $endpoint.$path.'regist.php' ;
    $no = $err_list["duplicate"];
    header("Location: {$url}?sidebar=5&no=".$no);
    exit;
  }

  pg_free_result($check_qu);
// // <---------- 重複のチェック終わり

// // <---------- log のための id GET
// kps_concert
// $_SESSION['login_name'] この二つの integer primary key を探す
$table_key;
$user_key = $_SESSION['id'];
$get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'kps_hall'");
while ($data = pg_fetch_object($get_table_key_qu)) {
  print_r ($data);
   $table_key = $data->db_table_id;
}

if (!isset($table_key) || !isset($user_key))  {
  // データが取れなかった
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=5&no=".$no);
  exit;
}
// <---------- log のための id GET終わり

// <---------- log
date_default_timezone_set('Asia/Tokyo'); //日本の標準時に合わせる
$now = date("Y-m-d H:i:s");
$log_query = "INSERT INTO log(log_target_table, log_event, log_editor, log_date)
VALUES ($1, $2, $3, $4)";
// insert into log(log_target_table,log_event, log_editor, log_date) values(0,'update', 16, '2016-12-05 14:43');
$result = pg_prepare($db_conn, "log", $log_query);
$result = pg_execute($db_conn, "log", array($table_key, 'add the hall:'.$hall_id, $user_key, $now ));
// <---------- log終わり

$insert_query = "INSERT INTO kps_hall(hall_id, hall_name, hall_address)
VALUES ($1, $2, $3)";

$result = pg_prepare($db_conn, "create_concert", $insert_query);

if (!$result) {
  echo "Failed to prepare $insert_query\n";
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=5&no=".$no);
  exit;
}

$result = pg_execute($db_conn, "create_concert", array($hall_id, $hall_name, $hall_address));

if (!$result) {
  echo "Failed to execute $insert_query \n";
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=5&no=".$no);
  exit;
}

pg_close($db_conn);

// 演奏会が正常に追加された
$url = $endpoint.$path.'all.php' ;
$return = 0;
$from = "add_hall";
header("Location: {$url}?sidebar=5&return=".$return."&from=".$from);
exit;
?>
</body>
</html>
