<html lang="ja">
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
                      <h1>演奏会を登録する</h1>
                    </div>
                  </div>
              </div>
          </div>

            <div class="bs-docs-section">
              <div class="row">
                <div class="col-lg-8">
                  <div class="well bs-component">
                    <form class="form-horizontal" action="regist_func.php" method="post">
                      <fieldset>
                        <legend>演奏会の情報の入力</legend>
<?php
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
);
$err_return = '';
if(isset($_GET['no'])) {
  $err_return = $_GET['no'];
}
else if ($err_return == $err_list["link_directly"]) {
echo <<<EOM

EOM;
}
if ($err_return == $err_list["duplicate"]) {
echo <<<EOM
<div class="form-group has-error">
  <label for="concertID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="concertID" name="concert_id">
    <span class="help-block">既に登録されたIDです。</span>
  </div>
</div>
EOM;
}
else {
echo <<<EOM
<div class="form-group">
  <label for="concertID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="concertID" name="concert_id">
    <span class="help-block">既に登録された値と重複した場合はエラーになります。</span>
  </div>
</div>
EOM;
}

echo <<<EOM
<div class="form-group">
  <label for="concertName" class="col-lg-2 control-label">演奏会名*</label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="concertName" name="concert_name">
  </div>
</div>
EOM;
echo <<<EOM
<div class="form-group">
   <label for="concertHall" class="col-lg-2 control-label">会場*</label>
   <div class="col-lg-10">
     <select class="form-control" id="concertHall" name="concert_hall">
EOM;

$database = "j140098t";
$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");
if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}
$qu = pg_query($db_conn, "SELECT h.hall_id, h.hall_name, h.hall_address
  FROM kps_hall h order by h.hall_id");

while ($data = pg_fetch_object($qu)) {
echo <<<EOM
        <option value=$data->hall_id>$data->hall_name</option>
EOM;
}

echo <<<EOM
      </select>
    </div>
</div>
<div class="form-group">
  <label for="concertComment" class="col-lg-2 control-label">コメント</label>
  <div class="col-lg-10">
    <textarea class="form-control" rows="3" id="concertComment" name="concert_comment"></textarea>
  </div>
</div>
 <div class="form-group">
  <label for="concertDate" class="col-lg-2 control-label">開催日*</label>
  <div class="col-lg-10">
    <select class="form-control" size="1" id="concertDate" name="concert_date_day">
EOM;
for ($i = 1; $i <= 31; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
    </select>
    <span class="help-block">日</span>
   <select class="form-control" size="1" id="concertDate" name="concert_date_month">
EOM;
for ($i = 1; $i <= 12; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
   </select>
   <span class="help-block">月</span>
   <select class="form-control" size="1" id="concertDate" name="concert_date_year">
EOM;
for ($i = 2016; $i <= 2050; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
   </select>
   <span class="help-block">年</span>
 </div>
</div>
<div class="form-group">
 <label for="concertOpen" class="col-lg-2 control-label">開場時間*</label>
 <div class="col-lg-10">
   <select class="form-control" size="1" id="concertOpen" name="concert_open_time_hour">
EOM;
for ($i = 0; $i <= 23; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
  　</select>
  <span class="help-block">時</span>
  <select class="form-control" size="1" id="concertOpen" name="concert_open_time_min">
EOM;
for ($i = 0; $i <= 59; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
 　</select>
 <span class="help-block">分</span>
 </div>
</div>
<div class="form-group">
 <label for="concertBegin" class="col-lg-2 control-label">開演時間*</label>
 <div class="col-lg-10">
   <select class="form-control" size="1" id="concertBegin" name="concert_begin_time_hour">
EOM;
for ($i = 0; $i <= 23; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
  　</select>
  <span class="help-block">時</span>
  <select class="form-control" size="1" id="concertBegin" name="concert_begin_time_min">
EOM;
for ($i = 0; $i <= 59; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
 　</select>
 <span class="help-block">分</span>
 </div>
</div>
EOM;

?>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.min.js"></script>

</body>
</html>
