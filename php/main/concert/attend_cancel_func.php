<?php session_start(); ?>

<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/";
$database = "j140098t";

$concert_id;
$member_id;
if(isset($_GET['concert_id']) && isset($_GET['member_id'])) {
  $concert_id = $_GET['concert_id'];
  $member_id = $_GET['member_id'];
} else {
  // 対象が指定されていない
  // $url = $endpoint.'main/concert/concert_detail.php?id='.$concert_id ;
  header("Location: {$url}");
  exit;
}

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  // データベース接続にエラーがある
  header("Location: attend.php?sidebar=1&no=".$no);
  exit;
}

$query = "DELETE FROM attend WHERE concert=$1 and member=$2";
$result = pg_prepare($db_conn, "delete", $query);
if (!$result) {
  // クエリにエラーがある
  header("Location: attend.php?sidebar=1&no=".$no);
  exit;
}
$result = pg_execute($db_conn, "delete", array($concert_id, $member_id));
if (!$result) {
  // 実行に失敗した
  header("Location: attend.php?sidebar=1&no=".$no);
  exit;
} else {
  // 正常に削除された

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
    $no = 4;
    header("Location: attend.php?sidebar=1&no=".$no);
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
  $result = pg_execute($db_conn, "log", array($table_key, 'cancel the attendance:'.$concert_id , $user_key, $now ));
  // <---------- log終わり

  // ログに書き込み
  log_delete();

  // $url = $endpoint.'main/concert/concert_detail.php';
  $return = 0;
  $from = "cancel_attend";
  header("Location: attend.php?return=".$return."&from=".$from."&id=".$concert_id);
  exit;
}

pg_free_result($qu);
pg_close($db_conn);


function log_delete($target, $db) // target: concert_id
  {
    echo "I don't exist until program execution reaches me.\n";

  }
 ?>
