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
  <td><a href="{$endpoint}main/hall/delete_hall_func.php?id={$data->hall_id}">削除</a></td>
</tr>
EOD;
  }

  pg_free_result($qu);
  pg_close($db_conn);
  ?>

    </tbody>
  </table>

</body>
</html>


-------
<html  lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Keio Piano Society</title>

  <link rel="stylesheet" type="text/css" href="../../../../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../../../assets/css/rild.css">
  <link rel="stylesheet" type="text/css" href="../../../../../assets/css/sidebar.css">

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
  include('../../../fragment/menubar.php');
  ?>

  <div id="wrapper">

      <!-- Sidebar -->
        <?php
        include('../../../fragment/sidebar_concert_admin.php');
        ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1>すべての演奏会会場</h1>
                    </div>
                  </div>
              </div>
          </div>

          <div class="bs-docs-section">

            <div class="row">
              <div class="col-lg-12">
                <div class="bs-component">
                  <ul class="breadcrumb">
                    <li class="active">Home</li>
                  </ul>

                  <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Library</li>
                  </ul>

                  <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                  </ul>
                </div>
              </div>

              <!-- Tables
              ================================================== -->
              <div class="col-lg-12">
                <div class="page-header">
                  <h1 id="tables">演奏会一覧</h1>
                </div>

<?php
$staging_endpoint = "http://131.113.100.213/~j140098t/login_project_sample/";
$endpoint = $staging_endpoint;
$database = "j140098t";
$edit = 0; // default
$edit_list = array(
    "default" => 0,
    "regist" => 1,
    "delete" => 2,
);

if(isset($_GET['edit'])) {
  $edit = $_GET['edit'];
}

// <----- CHECK query
if ($edit != $edit_list["default"] &&
$edit != $edit_list["regist"] &&
$edit != $edit_list["delete"]
) $edit = 0;
// <----- CHECK END
<form class="form-horizontal">
echo <<< EOD
                <table class="table table-striped table-hover ">
                    <thead>
                      <tr>
EOD;
if ($edit == $edit_list["delete"]) echo '<th></th>';
echo <<< EOD
                        <th>id</th>
                        <th>会場名</th>
                        <th>住所</th>
                      </tr>
                    </thead>
                      <tbody>
EOD;

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
EOD;
  if ($edit == $edit_list["delete"]) echo '<td><input type="checkbox"></td>';
echo <<< EOD
    <td>$data->hall_id</td>
    <td>$data->hall_name</td>
    <td>$data->hall_address</td>
  </tr>
EOD;
}

pg_free_result($qu);
pg_close($db_conn);

echo <<< EOD
                  </tbody>
                </table>
              </div><!-- /example -->
        <div class="col-lg-6">
          <div style="margin-bottom: 15px;">
           <div class="btn-toolbar bs-component" style="margin: 0;">
            <div class="btn-group">
EOD;

if ($edit == $edit_list["delete"]) {
echo <<< EOD
            <button type="submit" class="btn btn-primary">削除</button>
            </form>
            <div class="col-lg-6">
              <p class="bs-component">
                <a href="#" class="btn btn-default">キャンセル</a>
              </p>
            </div>
EOD;
} else {
  if ($edit == $edit_list["default"])
echo <<< EOD
<a href="#" class="btn btn-default">未選択</a>
<ul class="dropdown-menu">
  <li><a href="#">登録</a></li>
  <li><a href="#">削除</a></li>
</ul>
EOD;
}
 ?>
            </div>
           </div>
          </div>
        </div>

            </div> <!-- /row end -->
          </div>

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../../js/bootstrap.min.js"></script>

</body>
</html>
