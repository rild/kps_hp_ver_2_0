<html  lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Keio Piano Society</title>

  <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../../assets/css/rild.css">
  <link rel="stylesheet" type="text/css" href="../../../../assets/css/sidebar.css">
  <link rel="stylesheet" type="text/css" href="../../../../assets/font-awesome-4.7.0/css/font-awesome.min.css">

  <style type="text/css">

  </style>

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<!-- like index.php -->
<body>


  <?php
  include('../../fragment/menubar.php');
  ?>

  <div id="wrapper">

      <!-- Sidebar -->
      <?php
      include('../../fragment/sidebar_concert_admin.php');
      ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1>登録された演奏会の検索</h1>
                    </div>
                  </div>
              </div>
          </div>

          <div class="container-fluid">
          <div class="bs-docs-section">

            <div class="row">
              <div class="col-lg-6">
                <form class="navbar-form navbar-left" role="search" method="GET" action="./search.php">
                  <input type="hidden" name="sidebar" value="2">
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Search" name="search">
                   </div>
                 <button type="submit" class="btn btn-default">検索</button>
               </form>
              </div>
            </div>

            <div class="row">
              <!-- Tables
              ================================================== -->
              <div class="col-lg-12">
<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/concert/";

$database = "j140098t";
$keyword = '';
$search;
if(isset($_GET['search'])) {
  $keyword = "%".$_GET['search']."%";
  $search = $_GET['search'];
} else {
  exit;
}
$query = '';
$query = "
SELECT c.concert_id, c.concert_name, h.hall_name, c.concert_year, c.concert_month, c.concert_day,
  c.concert_begin_time_hour, c.concert_begin_time_min, c.concert_open_time_hour, c.concert_open_time_min
FROM kps_concert c, kps_hall h
WHERE c.concert_hall = h.hall_id and (c.concert_name::varchar like '{$keyword}'
  or c.concert_comment::varchar like '{$keyword}')
";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}
$qu = pg_query($db_conn, "{$query}");
echo <<<EOD
<div class="page-header">
  <small>検索ワード: $search</small>
</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>id</th>
      <th>演奏会名</th>
      <th>場所</th>
      <th>開催日</th>
      <th>開場</th>
      <th>開演</th>
      <th>詳細</th>
    </tr>
  </thead>
    <tbody>
EOD;

  while ($data = pg_fetch_object($qu)) {
    $date = $data->concert_year.'/'.str_pad($data->concert_month, 2, 0, STR_PAD_LEFT).'/'.str_pad($data->concert_day, 2, 0, STR_PAD_LEFT);
    $begin = str_pad($data->concert_begin_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_begin_time_min, 2, 0, STR_PAD_LEFT);
    $open = str_pad($data->concert_open_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_open_time_min, 2, 0, STR_PAD_LEFT);

echo <<< EOD
                    <tr>
                      <td>$data->concert_id</td>
                      <td>$data->concert_name</td>
                      <td>$data->hall_name</td>
                      <td>$date</td>
                      <td>$begin</td>
                      <td>$open</td>
                      <td>
                      <a href="{$endpoint}{$path}detail.php?sidebar=1&id={$data->concert_id}">
                      <i class="fa fa-arrow-circle-right" aria-hidden="true">
                      </i>
                      </a>
                      </td>
                    </tr>
EOD;
  }
echo <<<EOD
                  </tbody>
                </table>
              </div><!-- /example -->

              </div>
              </div> <!-- bs-docs-section end -->
              <div class="bs-docs-section">
              <div class="row">
        <div class="col-lg-6">
          <p class="bs-component">
          <a href="search.php?sidebar=2" class="btn btn-default">クリア</a>
          </p>
        </div>
            </div> <!-- row end CLEAR-->
            </div> <!-- bs-docs-section end CLEAR-->
EOD;

pg_free_result($qu);
pg_close($db_conn);

?>

        </div> <!-- container-end -->

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.min.js"></script>

</body>
</html>
