<?php session_start(); ?>

<?php

$staging_endpoint = "http://131.113.100.213/~j140098t/login_project_sample/";
$endpoint = $staging_endpoint;

$database = "j140098t";

$hall_id;

if(isset($_GET['id'])) {
  $hall_id = $_GET['id'];
} else {
  // 対象が指定されていない
  $url = $endpoint.'main/hall/delete_hall.php' ;
  header("Location: {$url}");
  exit;
}

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  // データベース接続にエラーがある
  echo "Failed connecting to postgres database $database\n";
  $url = $endpoint.'main/top.php' ;
  header("Location: {$url}");
  exit;
}

$query = "DELETE FROM kps_hall WHERE hall_id=$1";
$result = pg_prepare($db_conn, "delete", $query);
if (!$result) {
  // クエリにエラーがある
  $url = $endpoint.'main/hall/delete_hall.php' ;
  header("Location: {$url}");
  exit;
}
$result = pg_execute($db_conn, "delete", array($hall_id));
if (!$result) {
  // 実行に失敗した
  $url = $endpoint.'main/hall/delete_hall.php' ;
  header("Location: {$url}");
  exit;
} else {
  // 正常に削除された

  // // <---------- log のための id GET
  // kps_concert
  // $_SESSION['login_name'] この二つの integer primary key を探す
  $table_key;
  $user_key;
  $get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'kps_hall'");
  $get_user_key_qu = pg_query($db_conn, "SELECT id FROM member WHERE member.login_name = '{$_SESSION['login_name']}'");

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
    $url = $endpoint.'main/hall/delete_hall.php' ;
    $no = 4;
    header("Location: {$url}?no=".$no);
    exit;
  }
  // <---------- log のための id GET終わり

  // <---------- log
  date_default_timezone_set('JST'); //日本の標準時に合わせる
  $now = date("Y-m-d H:i:s");
  $log_query = "INSERT INTO log(log_target_table, log_event, log_editor, log_date)
  VALUES ($1, $2, $3, $4)";
  // insert into log(log_target_table,log_event, log_editor, log_date) values(0,'update', 16, '2016-12-05 14:43');
  $result = pg_prepare($db_conn, "log", $log_query);
  $result = pg_execute($db_conn, "log", array($table_key, 'delete the hall:'.$hall_id , $user_key, $now ));
  // <---------- log終わり

  // ログに書き込み
  log_delete();

  $url = $endpoint.'main/hall/hall.php' ;
  $return = 0;
  $from = "delete_hall";
  header("Location: {$url}?return=".$return."&from=".$from);
  exit;
}

pg_free_result($qu);
pg_close($db_conn);


function log_delete($target, $db) // target: concert_id
  {
    echo "I don't exist until program execution reaches me.\n";

  }
 ?>
