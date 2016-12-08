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
                  <div class="bs-component">
                    <ul class="breadcrumb">
                      <li><a href="all.php?sidebar=5">List</a></li>
                      <li class="active">Delete</li>
                    </ul>
                  </div>
                </div>

                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1>すべての演奏会会場</h1>
                    </div>
                  </div>
              </div>
          </div>

          <div class="bs-docs-section">

            <div class="row">

              <!-- Tables
              ================================================== -->
              <div class="col-lg-12">
<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/admin/concert/hall/";
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
echo <<< EOD
                <form class="form-horizontal" action="delete_func.php" method="post">
                <table class="table table-striped table-hover ">
                    <thead>
                      <tr>
                        <th><a href="delete.php?sidebar=5" class="btn btn-link">Reset</a></th>
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

$size = 0;
while ($data = pg_fetch_object($qu)) {
echo <<< EOD
  <tr>
    <td><input type="checkbox" name="row{$size}" value="$data->hall_id"></td>
    <td>$data->hall_id</td>
    <td>$data->hall_name</td>
    <td>$data->hall_address</td>
  </tr>
EOD;
$size++;
}

pg_free_result($qu);
pg_close($db_conn);

echo <<< EOD
                  </tbody>
                </table>
                <input type="hidden" name="size" value="{$size}">
                <button type="submit" class="btn btn-primary">削除</button>

                </form>
              </div><!-- /example -->

              </div> <!-- /row end -->
            </div> <!-- section end -->

EOD;

 ?>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../../js/bootstrap.min.js"></script>

</body>
</html>
