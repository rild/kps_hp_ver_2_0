<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>リダイレクト : 参加情報を登録しています</title>
</head>

<body>
<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/";

$concert_id;
$member_id;
$role_id;

if(isset($_GET['concert_id']) && isset($_GET['member_id']) && isset($_POST['role_id'])) {
  $concert_id = $_GET['concert_id'];
  $member_id = $_GET['member_id'];
  $role_id = $_POST['role_id'];
}


$db_conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

// // <---------- 重複のチェック
$check_qu = pg_query($db_conn, "SELECT member, role, concert FROM attend");
$check_flag = 0;
  while ($data = pg_fetch_object($check_qu)) {
    print_r ($data);
    if ($data->member == $member_id &&
      $data->role == $role_id &&
      $data->concert == $concert_id) $check_flag = -1;
  }
  if ($check_flag < 0) {
    // Already registed the datum
    // $url = $endpoint.'main/concert/concert_detail.php?id='.$concert_id ;
    $no = 3;
    header("Location: attend.php?sidebar=1&no=".$no);
    exit;
  }
  pg_free_result($check_qu);
// // <---------- 重複のチェック終わり

// // <---------- log のための id GET
// kps_concert
// $_SESSION['login_name'] この二つの integer primary key を探す
$table_key;
$user_key = $_SESSION['id'];
$get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'attend'");

while ($data = pg_fetch_object($get_table_key_qu)) {
  print_r ($data);
   $table_key = $data->db_table_id;
}

if (!isset($table_key) || !isset($user_key))  {
  // データが取れなかった
  // $url = $endpoint.'main/concert/concert_detail.php?id='.$concert_id ;
  print "{$url}";
  $no = 4;
  header("Location: attend.php?sidebar=1&no=".$no);
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
$result = pg_execute($db_conn, "log", array($table_key, 'regist the attend on:'.$concert_id, $user_key, $now ));
// <---------- log終わり

$insert_query = "INSERT INTO attend VALUES ($1, $2, $3)";

$result = pg_prepare($db_conn, "regist_attend", $insert_query);

if (!$result) {
  echo "Failed to prepare $insert_query\n";
  exit;
}

$result = pg_execute($db_conn, "regist_attend", array($member_id, $role_id, $concert_id));

if (!$result) {
  echo "Failed to execute $insert_query \n";
  exit;
}

echo "Success\n";

pg_close($db_conn);

// 演奏会が正常に追加された
// $url = $endpoint.'main/concert/concert_detail.php';
$return = 0;
$from = "regist_attend";
header("Location: attend.php?return=".$return."&from=".$from."&id=".$concert_id);
exit;

?>
</body>
</html>
