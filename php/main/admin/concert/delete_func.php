<?php session_start(); ?>

<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
);

$database = "j140098t";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  // データベース接続にエラーがある
  echo "Failed connecting to postgres database $database\n";
  $url = $endpoint.'main/top.php' ;
  header("Location: {$url}");
  exit;
}

$query = "DELETE FROM kps_concert WHERE concert_id=$1";
$result = pg_prepare($db_conn, "delete", $query);
if (!$result) {
  // クエリにエラーがある
  $url = $endpoint.$path.'delete.php' ;
  header("Location: {$url}?sidebar=4");
  exit;
}

$size = 0;
if(isset($_POST['size'])) {
  $size = $_POST['size'];
} else {
  $url = $endpoint.$path.'delete.php' ;
  header("Location: {$url}?sidebar=4");
  exit;
}
$concert_id;
for ($i = 0; $i < $size; $i++) {
  if(isset($_POST['row'.$i])) {
    $concert_id = $_POST['row'.$i];
  } else {
    continue;
  }

  $result = pg_execute($db_conn, "delete", array($concert_id));
  if (!$result) {
    // 実行に失敗した
    $url = $endpoint.$path.'delete.php' ;
    header("Location: {$url}?sidebar=4");
    exit;
  } else {
    // 正常に削除された

    // // <---------- log のための id GET
    // kps_concert
    // $_SESSION['login_name'] この二つの integer primary key を探す
    $table_key;
    $user_key = $_SESSION['id'];
    $get_table_key_qu = pg_query($db_conn, "SELECT db_table_id FROM table_list WHERE table_list.db_table_name = 'kps_concert'");
    while ($data = pg_fetch_object($get_table_key_qu)) {
       $table_key = $data->db_table_id;
    }

    if (!isset($table_key) || !isset($user_key))  {
      // データが取れなかった
      $url = $endpoint.$path.'delete.php' ;
      $no = 4;
      header("Location: {$url}?sidebar=4&no=".$no);
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
    $result = pg_execute($db_conn, "log", array($table_key, 'delete the concert:'.$concert_id , $user_key, $now ));
    // <---------- log終わり

  }
}

pg_free_result($query);
pg_close($db_conn);

$url = $endpoint.$path.'delete.php' ;
$return = 0;
$from = "delete_concert";
header("Location: {$url}?sidebar=4&return=".$return."&from=".$from);
exit;
 ?>
