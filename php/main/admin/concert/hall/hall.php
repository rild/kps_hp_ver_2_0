<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>イベント管理サイト(仮) 演奏会管理</title>
</head>

<!-- like index.php -->
<body>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>id</th>
      <th>会場名</th>
      <th>住所</th>
    </tr>

  </thead>
  <tbody>

<?php
$staging_endpoint = "http://131.113.100.213/~j140098t/login_project_sample/";
$endpoint = $staging_endpoint;
$database = "j140098t";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

$qu = pg_query($db_conn, "SELECT h.hall_id, h.hall_name, h.hall_address
  FROM kps_hall h order by h.hall_id");

while ($data = pg_fetch_object($qu)) {
  echo <<< EOD
  <tr>
    <td>$data->hall_id</td>
    <td>$data->hall_name</td>
    <td>$data->hall_address</td>
  </tr>
EOD;
}

pg_free_result($qu);
pg_close($db_conn);
?>

  </tbody>
</table>

 <a href="add_hall.php" class="btn btn-default">追加</a>
 <br>
 <a href="delete_hall.php" class="btn btn-default">削除</a>
<br>
<br>
 <a href="../top.php" class="btn btn-default">TOPへ</a>


</body>
</html>
