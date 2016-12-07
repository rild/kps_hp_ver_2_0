<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>リダイレクト : 演奏会を登録しています</title>
</head>

<body>
<?php
$staging_endpoint = "http://131.113.100.213/~j140098t/login_project_sample/";
$endpoint = $staging_endpoint;
//
if (!isset($_POST['hall_id']) || !isset($_POST['hall_name'])) {
  // link directly
  $url = $endpoint.'main/hall/add_hall.php' ;
  $no = 1;
  header("Location: {$url}?no=".$no);
  exit;
}

// http://php.net/manual/ja/function.compact.php PHP array に変数を入れる

$hall_id = $_POST['hall_id'];
$hall_name = $_POST['hall_name'];
$hall_address = $_POST['hall_address'];

$db_conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

// // <---------- 重複のチェック
$check_qu = pg_query($db_conn, "SELECT hall_id FROM kps_hall");
$check_flag = 0;
  while ($data = pg_fetch_object($check_qu)) {
    if ($data->hall_id == $hall_id) $check_flag = -1;
  }
  if ($check_flag < 0) {
    print "重複しました";
    $url = $endpoint.'main/hall/add_hall.php' ;
    $no = 3;
    header("Location: {$url}?no=".$no);
    exit;
  }

  pg_free_result($check_qu);
// // <---------- 重複のチェック終わり

// // <---------- log のための id GET
// kps_concert
// $_SESSION['login_name'] この二つの integer primary key を探す
$table_key;
$user_key;
$get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'kps_hall'");
$get_user_key_qu = pg_query($db_conn, "SELECT id FROM member WHERE member.login_name = '{$_SESSION['login_name']}'");
print "{$get_table_key_qu}";
print "{$get_user_key_qu}";
$check_flag = 0;
while ($data = pg_fetch_object($get_table_key_qu)) {
  print_r ($data);
   $table_key = $data->db_table_id;
}
while ($data = pg_fetch_object($get_user_key_qu)) {
  print_r ($data);
   $user_key = $data->id;
}

if (!isset($table_key) || !isset($user_key))  {
  // データが取れなかった
  $url = $endpoint.'main/hall/add_hall.php' ;
  print "{$url}";
  $no = 4;
  header("Location: {$url}?no=".$no);
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

// ログ出し
// log_create();

$insert_query = "INSERT INTO kps_hall(hall_id, hall_name, hall_address)
VALUES ($1, $2, $3)";

$result = pg_prepare($db_conn, "create_concert", $insert_query);

if (!$result) {
  echo "Failed to prepare $insert_query\n";
  exit;
}

$result = pg_execute($db_conn, "create_concert", array($hall_id, $hall_name, $hall_address));

if (!$result) {
  echo "Failed to execute $insert_query \n";
  exit;
}

echo "Success\n";

pg_close($db_conn);

// 演奏会が正常に追加された
$url = $endpoint.'main/hall/hall.php' ;
$return = 0;
$from = "add_hall";
header("Location: {$url}?return=".$return."&from=".$from);
exit;

// function log_create()
//   {
//     echo "I don't exist until program execution reaches me.\n";
//
//
//   }
?>
</body>
</html>
