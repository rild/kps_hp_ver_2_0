<!-- TODO クエリでページ移動 GET -->

<html  lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Keio Piano Society</title>

  <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../../assets/css/rild.css">
  <link rel="stylesheet" type="text/css" href="../../../../assets/css/sidebar.css">

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
                <?php
                include('../../fragment/top_message.php');
                ?>
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1>登録された演奏会の削除</h1>
                    </div>
                  </div>
              </div>
          </div>

          <div class="bs-component">
            <form class="form-horizontal" action="delete_func.php" method="post">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th><a href="delete.php?sidebar=4" class="btn btn-link">Reset</a></th>
                  <th>id</th>
                  <th>演奏会名</th>
                  <th>場所</th>
                  <th>開催日</th>
                  <th>開場</th>
                  <th>開演</th>
                </tr>
              </thead>
              <tbody>
<?php
$database = "j140098t";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

$qu = pg_query($db_conn, "SELECT c.concert_id, c.concert_name, h.hall_name, c.concert_year, c.concert_month, c.concert_day,
  c.concert_begin_time_hour, c.concert_begin_time_min, c.concert_open_time_hour, c.concert_open_time_min
  FROM kps_concert c, kps_hall h where c.concert_hall = h.hall_id");

  while ($data = pg_fetch_object($qu)) {
    $date = $data->concert_year.'/'.str_pad($data->concert_month, 2, 0, STR_PAD_LEFT).'/'.str_pad($data->concert_day, 2, 0, STR_PAD_LEFT);
    $begin = str_pad($data->concert_begin_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_begin_time_min, 2, 0, STR_PAD_LEFT);
    $open = str_pad($data->concert_open_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_open_time_min, 2, 0, STR_PAD_LEFT);

$size = 0;
echo <<< EOD
    <tr>
     <td><input type="checkbox" name="row{$size}" value="$data->concert_id"></td>
      <td>$data->concert_id</td>
      <td>$data->concert_name</td>
      <td>$data->hall_name</td>
      <td>$date</td>
      <td>$begin</td>
      <td>$open</td>
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
EOD;
?>
              <!-- </tbody>
            </table>
            <input type="hidden" name="size" value="{$size}">
            <button type="submit" class="btn btn-primary">削除</button>

            </form>
          </div> -->

          <!-- <div class="row">
            <div class="col-lg-6">
              <p class="bs-component">
                <a href="#" class="btn btn-default">Default</a>
              </p>
            </div>
          </div> -->


      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.min.js"></script>

</body>
</html>
