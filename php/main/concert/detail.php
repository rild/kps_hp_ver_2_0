<html  lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Keio Piano Society</title>

  <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/rild.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/sidebar.css">

  <style type="text/css">

  </style>

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<!-- like index.php -->
<body>

<!-- TOFIX ADMIN -->
  <?php
  include('../fragment/menubar.php');
  ?>

  <div id="wrapper">

<!-- TOFIX ADMIN -->
      <!-- Sidebar -->
        <?php
        include('../fragment/sidebar_concert_admin.php');
        ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="bs-component">
                  <!-- <ul class="breadcrumb">
                    <li class="active">List</li>
                  </ul> -->

<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/";
echo <<<EOD
                  <ul class="breadcrumb">
                    <li><a href="{$endpoint}{$path}all.php?sidebar=1">List</a></li>
                    <li class="active">Detail</li>
                  </ul>
EOD;
 ?>
                </div>
              </div>

                <div class="col-lg-12">
                  <div class="page-header">
                    <h1>演奏会詳細</h1>
                  </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
          <div class="bs-docs-section">
<?php
// <----- bs-docs-section start
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/";

$database = "j140098t";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
);

$concert_id;
// $member_id = $_SESSION['id'];;
//
// if (isset($_SESSION['id'])) {
//   $member_id = $_SESSION['id'];
// } else {
//   $url = $endpoint.$path."all.php" ;
//   $no = $err_list[link_directly];
//   header("Location: {$url}?taeget=0&sidebar=1&no=".$no);
//   exit;
// }
if(isset($_GET['id'])) {
  $concert_id = $_GET['id'];
} else {
  // 対象が指定されていない
  $url = $endpoint.$path."all.php" ;
  $no = $err_list[link_directly];
  header("Location: {$url}?taeget=1&sidebar=1&no=".$no);
  exit;
}

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");
if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  $url = $endpoint.$path."all.php" ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=1&no=".$no);
  exit;
}

$qu = pg_query($db_conn, "SELECT c.concert_id, c.concert_name, h.hall_name, c.concert_comment, c.concert_year, c.concert_month, c.concert_day,
  c.concert_begin_time_hour, c.concert_begin_time_min, c.concert_open_time_hour, c.concert_open_time_min
  FROM kps_concert c, kps_hall h where c.concert_hall = h.hall_id and c.concert_id = {$concert_id}");


while ($data = pg_fetch_object($qu)) {
  $date = $data->concert_year.'/'.str_pad($data->concert_month, 2, 0, STR_PAD_LEFT).'/'.str_pad($data->concert_day, 2, 0, STR_PAD_LEFT);
  $begin = str_pad($data->concert_begin_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_begin_time_min, 2, 0, STR_PAD_LEFT);
  $open = str_pad($data->concert_open_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_open_time_min, 2, 0, STR_PAD_LEFT);

  echo <<< EOD
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                <div class="jumbotron">
                  <h1>$data->concert_name</h1>
                  <p>$data->concert_comment</p>
                  <p><a class="btn btn-primary btn-lg" href="attend?sidebar=1&id={$concert_id}">参加状況確認</a></p>
                </div>
              </div>
            </div>
        </div> <!-- /row end -->
        <div class="row">
            <div class="col-lg-6">
              <div class="panel panel-default">
                <div class="panel-heading">会場</div>
                <div class="panel-body">
                  $data->hall_name
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="panel panel-default">
                <div class="panel-heading">開催日</div>
                <div class="panel-body">
                  $date
                </div>
              </div>
            </div>
        </div> <!-- /row end -->
        <div class="row">
            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">開場時間</div>
                <div class="panel-body">
                  $open
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="panel panel-default">
                <div class="panel-heading">開演時間</div>
                <div class="panel-body">
                  $begin
                </div>
              </div>
            </div>
        </div> <!-- /row end -->
EOD;
}
 // <----- bs-docs-section end
 ?>
          </div>
        </div>

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
