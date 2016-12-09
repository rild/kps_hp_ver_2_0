<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>リダイレクト : 演奏会を登録しています</title>
</head>

<body>
<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/member/";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
    "nodata" => 4,
    "password_differ" => 5,
);

if (!isset($_POST['member_id']) || !isset($_POST['member_login_id']) ||
!isset($_POST['member_passw']) || !isset($_POST['member_passw_conf'])) {
  // link directly
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["link_directly"];
  header("Location: {$url}?sidebar=3&no=".$no);
  exit;
}
if (empty($_POST['member_id']) || empty($_POST['member_login_id']) ||
empty($_POST['member_passw']) || empty($_POST['member_passw_conf'])) {
  // link directly
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["nodata"];
  header("Location: {$url}?sidebar=3&no=".$no);
  exit;
}

// http://php.net/manual/ja/function.compact.php PHP array に変数を入れる

$member_id = $_POST['member_id'];
$member_login_id = $_POST['member_login_id'];
$member_passw = $_POST['member_passw'];
$member_passw_conf = $_POST['member_passw_conf'];

$member_name = $_POST['member_name'];
$member_birthday;
if (!empty($_POST['member_birthday_year']) && !empty($_POST['member_birthday_month']) &&
!empty($_POST['member_birthday_day'])) {
  $member_birthday = $_POST['member_birthday_year']."-".str_pad($_POST['member_birthday_month'], 2, 0, STR_PAD_LEFT)."-".str_pad($_POST['member_birthday_day'], 2, 0, STR_PAD_LEFT);
}
$member_mail_address = $_POST['member_mail_address'];

if ($member_passw != $member_passw_conf) {
  // 確認用パスワードが違っている
  $url = $endpoint.$path.'regist.php' ;
  $no = $err_list["password_differ"];
  header("Location: {$url}?no=".$no);
  exit;
}
$db_conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

// // <---------- 重複のチェック
$check_qu = pg_query($db_conn, "SELECT id, login_name FROM member");
$check_flag = 0;
  while ($data = pg_fetch_object($check_qu)) {
    if ($data->id == $member_id || $data->login_name == $member_login_id) $check_flag = -1;
  }
  if ($check_flag < 0) {
    print "重複しました";
    $url = $endpoint.'main/member/add_member.php' ;
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
$user_key = $_SESSION['id'];
$get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'member'");
while ($data = pg_fetch_object($get_table_key_qu)) {
  print_r ($data);
   $table_key = $data->db_table_id;
}
if (!isset($table_key) || !isset($user_key))  {
  // データが取れなかった
  $url = $endpoint.$path.'regist.php' ;
  print "{$url}";
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=3&no=".$no);
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
$result = pg_execute($db_conn, "log", array($table_key, 'add the member account:'.$member_id, $user_key, $now ));
// <---------- log終わり

// ログ出し
// log_create();

$insert_query = "INSERT INTO member(id, login_name, password)
VALUES ($1, $2, $3)";

$result = pg_prepare($db_conn, "create_concert", $insert_query);

if (!$result) {
  echo "Failed to prepare $insert_query\n";
  exit;
}

$member_hashpwd = password_hash($member_passw, PASSWORD_DEFAULT);
$result = pg_execute($db_conn, "create_concert", array($member_id, $member_login_id, $member_hashpwd));

if (!$result) {
  echo "Failed to execute $insert_query \n";
  exit;
}

echo "Success\n";

pg_close($db_conn);

// 演奏会が正常に追加された
$url = $endpoint.$path.'all.php' ;
$return = 0;
$from = "create_member_account";
header("Location: {$url}?sidebar=1&return=".$return."&from=".$from);
exit;
?>
</body>
</html>
