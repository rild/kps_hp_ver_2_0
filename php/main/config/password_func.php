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
$path = "php/main/config/";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
    "nodata" => 4,
    "password_differ" => 5,
);

if (!isset($_POST['member_id']) || !isset($_POST['member_login_name']) ||
!isset($_POST['member_passw']) || !isset($_POST['member_passw_conf'])) {
  // link directly
  $url = $endpoint.$path.'password.php' ;
  $no = $err_list["link_directly"];
  header("Location: {$url}?sidebar=3&no=".$no);
  exit;
}
if (empty($_POST['member_id']) || empty($_POST['member_login_name']) ||
empty($_POST['member_passw']) || empty($_POST['member_passw_conf'])) {
  // link directly
  $url = $endpoint.$path.'password.php' ;
  $no = $err_list["nodata"];
  header("Location: {$url}?sidebar=3&no=".$no);
  exit;
}

$id = $_POST['member_id'];
$login_name = $_POST['member_login_name'];
$password_old = $_POST['member_passw_old'];
$password = $_POST['member_passw'];
$password_conf = $_POST['member_passw_conf'];

if ($password != $password_conf) {
  // 確認用パスワードが違っている
  $url = $endpoint.$path.'password.php' ;
  $no = $err_list["password_differ"];
  header("Location: {$url}?no=".$no);
  exit;
}
$db_conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}
$query = "SELECT * FROM member WHERE login_name=$1";
$result = pg_prepare ($db_conn, "check_old_pass", $query);

$result = pg_execute ($db_conn, "check_old_pass", array($login_name));

# check existance in DB
if(pg_num_rows($result)==1){
  $row = pg_fetch_assoc($result,0);
  if(!password_verify($password_old,$row['password'])){
    $url = $endpoint.$path.'password.php' ;
    $no = $err_list["password_differ"];
    header("Location: {$url}?sidebar=3&no=".$no);
    exit;
  }
} else {
  // DBにHITしない ユーザ名が存在しない
  $url = $endpoint.$path.'password.php' ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=3&no=".$no);
  exit;
}

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
  $url = $endpoint.$path.'password.php' ;
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
$result = pg_execute($db_conn, "log", array($table_key, 'chang own password:'.$id, $user_key, $now ));
// <---------- log終わり

// ログ出し
// log_create();

$update_query = "UPDATE member SET password = $1 WHERE id = {$id}";

$result = pg_prepare($db_conn, "create_concert", $update_query);

if (!$result) {
  echo "Failed to prepare $update_query\n";
  exit;
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);
$result = pg_execute($db_conn, "create_concert", array($password_hash));

if (!$result) {
  echo "Failed to execute $update_query \n";
  exit;
}

echo "Success\n";

pg_close($db_conn);

// パスワードが正常に更新された
$url = $endpoint.$path.'password.php' ;
$return = 0;
$from = "update_account_password";
header("Location: {$url}?sidebar=3&return=".$return."&from=".$from);
exit;
?>
</body>
</html>
