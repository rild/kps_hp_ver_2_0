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


  <?php
  include('../fragment/menubar.php');
  ?>

  <div id="wrapper">

      <!-- Sidebar -->
      <?php
      include('../fragment/sidebar_config.php');
      ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1 id="type">User Config</h1>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <blockquote>
                     <p>UserのTopページ。左のサイドニューから選択をしてください。</p>
                     <small>このページではアカウント情報の確認と編集ができます。</small>
                   </blockquote>
                  </div>
              </div>  <!-- row -->

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

$qu = pg_query($db_conn, "    select
            m.id as id
            , m.login_name as login_name
            , md.member_detail_name as name
            , md.member_detail_birthday as birthday
            , md.member_detail_mail as mail
        from
            member m
        left outer join
            member_detail md
        on
            m.id = 16
            and m.id = md.member");

$qu = pg_query($db_conn, "    select
            m.id as id
            , m.login_name as login_name
            , md.member_detail_name as name
            , md.member_detail_birthday as birthday
            , md.member_detail_mail as mail
        from
            member m, member_detail md
        where m.id = md.member
            and m.id = 16");


  while ($data = pg_fetch_object($qu)) {
    echo <<< EOD
    <tr>
      <td>$data->id</td>
      <td>$data->login_name</td>
      <td>$data->name</td>
      <td>$data->birthday</td>
      <td>$data->mail</td>
    </tr>
EOD;
  }

pg_free_result($qu);
pg_close($db_conn);

?>
              <div class="row">
                <div class="col-lg-12">
                </div>  <!-- row -->
              </div>    <!-- container-fluid -->

          </div>    <!-- container-fluid -->
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
