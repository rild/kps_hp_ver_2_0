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
      include('../../fragment/sidebar_member_admin.php');
      ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1 id="type">Member</h1>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <blockquote>
                     <p>MemberのTopページ。左のサイドニューから選択をしてください。</p>
                     <small>Member > Top にはサイトの更新履歴などのログが表示されます。</small>
                   </blockquote>
                  </div>
              </div>
          </div>

<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/concert/";

$database = "j140098t";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

$qu = pg_query($db_conn, "
select id, login_name
from member
order by id desc");

$top_concert_array = array(
    0 => Array
        (
            "id" => -1,
            "name" => ""
        ),
    1 => Array
          (
              "id" => -1,
              "name" => ""
          ),
    2 => Array
        (
            "id" => -1,
            "name" => ""
        ),
    3 => Array
          (
              "id" => -1,
              "name" => ""
          ),
    4 => Array
        (
            "id" => -1,
            "name" => ""
        ),
);
$size = sizeof($top_concert_array);
$total = 0;
while ($data = pg_fetch_object($qu)) {
  if ($total < $size) {
    $top_concert_array[$total]["id"] = $data->id;
    $top_concert_array[$total]["name"] = $data->login_name;
  }
$total++;
  }
echo <<<EOD
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4">
      <div class="bs-component">
        <p class="text-muted">サイトに登録されているアカウント数</p>
        <ul class="list-group">
          <li class="list-group-item">
            <span class="badge">$total</span>
            Members Account all registed
          </li>
        </ul>
      </div>
    </div>
EOD;

echo <<< EOD
    <div class="col-lg-4">
      <div class="bs-component">
        <p class="text-muted">Memberページ更新履歴 <small>new</small></p>
        <div class="list-group">
EOD;

$qu = pg_query($db_conn, "SELECT l.log_id, tl.db_table_name, l.log_event, m.login_name, l.log_date
  FROM log l, member m, table_list tl
  where l.log_target_table = tl.db_table_id and l.log_editor = m.id and
  tl.db_table_name = 'member'
  order by l.log_id desc");
$log_size = 5;
$i = 0;
  while ($data = pg_fetch_object($qu)) {
    if ($i > $log_size) break;
echo <<< EOD
<a href="#" class="list-group-item">
  <h4 class="list-group-item-heading">$data->log_event</h4>
  <p class="list-group-item-text">$data->log_date</p>
  <small>Editor: $data->login_name</small>
</a>
EOD;
$i++;
  }

pg_free_result($qu);
pg_close($db_conn);
?>
                  </div>
                </div>
              </div>
            </div>
          <div>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.min.js"></script>

</body>
</html>
