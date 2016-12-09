<?php session_start(); ?>

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

$database = "j140098t";
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
);

$concert_id;
$member_id = $_SESSION['id'];

if(isset($_GET['id'])) {
  $concert_id = $_GET['id'];
} else {
  // 対象が指定されていない
  $url = $endpoint.$path."all.php" ;
  $no = $err_list[link_directly];
  header("Location: {$url}?taeget=1&sidebar=1&no=".$no);
  exit;
}


echo <<<EOD
                  <ul class="breadcrumb">
                    <li><a href="{$endpoint}{$path}all.php?sidebar=1">List</a></li>
                    <li><a href="detail.php?sidebar=1&id={$concert_id}">Detail</a></li>
                    <li class="active">Attend</li>
                  </ul>
                </div>
              </div>
            </div>
        </div>

        <div class="container-fluid">
          <div class="bs-docs-section">
EOD;

// <----- bs-docs-section start

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");
if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  $url = $endpoint.$path."all.php" ;
  $no = $err_list["db_connection"];
  header("Location: {$url}?sidebar=1&no=".$no);
  exit;
}

$query = "
 select r.role_name from attend a, role r
 where a.role = r.role_id and a.member = {$member_id} and a.concert = {$concert_id};
";
$qu = pg_query($db_conn, "{$query}");
$flag = 0;
$role;
while ($data = pg_fetch_object($qu)) {
  //参加する場合
  $flag = 1;
  $role = $data->role_name;
}

if ($flag == 1) {
echo <<<EOD
<div class="row">
   <div class="col-lg-12">
     <h2 id="type-blockquotes">あなたは参加登録がされています。</h2>
   </div>
</div>
<div class="row">
  <div class="col-lg-6">
     <div class="bs-component">
       <blockquote>
         <p>当日のあなたの区分は $role です。</p>
         <small>
         <cite title="Source Title">staff</cite>: スタッフ,
         <cite title="Source Title">player</cite>: 演奏者,
         <cite title="Source Title">guest</cite>: ゲスト
         </small>
       </blockquote>
     </div>
 </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <p class="bs-component">
      <a class="btn btn-primary" href="./attend_cancel_func.php?concert_id={$concert_id}&member_id={$_SESSION['id']}">
      取り消し</a>
    </p>
  </div>
</div>

EOD;
}
else {
echo <<<EOD
<div class="row">
   <div class="col-lg-12">
     <h2 id="type-blockquotes">あなたの参加登録はありません。</h2>
   </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="well bs-component">
<form method="POST" action="./attend_regist_func.php?concert_id={$concert_id}&member_id={$_SESSION['id']}">
<fieldset>
  <legend>参加登録</legend>
<div class="form-group">
   <label for="concertHall" class="col-lg-2 control-label">区分*</label>
   <div class="col-lg-10">
    <select class="form-control" id="role" name="role_id">
EOD;
$qu = pg_query($db_conn, "SELECT r.role_id, r.role_name
  FROM role r order by r.role_id");
  // staff かつ player の時があるから要修正
while ($data = pg_fetch_object($qu)) {
echo <<< EOD
        <option value=$data->role_id>$data->role_name</option>
EOD;
}

echo <<< EOD
     </select>
    </div>
 </div>
 <div class="form-group">
   <div class="col-lg-10 col-lg-offset-2">
     <button type="submit" class="btn btn-primary">参加</button>
   </div>
 </div>
</fieldset>
</form>
    </div>
  </div>
</div>
EOD;
}

echo <<<EOD
            </div>
          </div>
EOD;
    // <----- bs-docs-section end
// <----- container-fluid end

echo <<<EOD
<div class="bs-docs-section">

  <div class="row">
    <div class="col-lg-12">
      <div class="page-header">
        <h1>参加状況一覧</h1>
      </div>
    </div>
    <div class="col-lg-12">
        <table class="table table-striped table-hover ">
          <thead>
            <tr>
              <th>名前</th>
              <th>区分</th>
            </tr>
          </thead>
          <tbody>
EOD;
$qu = pg_query($db_conn, "SELECT m.login_name, r.role_name
  FROM attend a, role r, member m
  WHERE a.member = m.id and a.role = r.role_id and a.concert = '{$concert_id}' order by r.role_id");

$flag = 0;
while ($data = pg_fetch_object($qu)) {
  $flag = 1;
echo <<< EOD
<tr>
  <th>$data->login_name</th>
  <th>$data->role_name</th>
</tr>
EOD;
}

if ($flag == 0) {
echo <<<EOD
<tr>
  <th>--</th>
  <th>--</th>
</tr>
EOD;
}
echo <<<EOD
      </tbody>
      </table>
  </div>
 </div>
</div>
EOD;
// <----- col end
// <----- row end
// <----- bs-docs-section end

pg_free_result($qu);

 ?>

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
