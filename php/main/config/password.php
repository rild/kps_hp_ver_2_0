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

<?php
include('../fragment/top_message.php');
?>
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
              </div>
          </div>

          <div class="bs-docs-section">
            <div class="row">
              <div class="col-lg-8">
                <div class="well bs-component">
                  <form class="form-horizontal" action="password_func.php" method="post">
                    <fieldset>
                      <legend>パスワードの入力</legend>
<?php
$err_list = array(
    "link_directly" => 1,
    "db_connection" => 2,
    "duplicate" => 3,
    "nodata" => 4,
    "password_differ" => 5,
);
$err_return = '';
if(isset($_GET['no'])) {
$err_return = $_GET['no'];
}
else if ($err_return == $err_list["link_directly"]) {
echo <<<EOM

EOM;
}
echo <<<EOM
<input type="hidden" name="member_id" value="{$_SESSION['id']}">
<input type="hidden" name="member_login_name" value="{$_SESSION['login_name']}">
<div class="form-group">
<label for="memberPass" class="col-lg-2 control-label">現在のパスワード</label>
<div class="col-lg-10">
  <input type="password" class="form-control" id="memberPass" name="member_passw_old">
</div>
</div>

<div class="form-group">
<label for="memberPass" class="col-lg-2 control-label">新しいパスワード</label>
<div class="col-lg-10">
  <input type="password" class="form-control" id="memberPass" name="member_passw">
</div>
</div>
<div class="form-group">
<label for="memberPassConf" class="col-lg-2 control-label">新しいパスワード</label>
<div class="col-lg-10">
  <input type="password" class="form-control" id="memberPassConf" name="member_passw_conf">
  <span class="help-block">入力確認用。</span>
</div>
</div>
EOM;

?>

                      <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                          <button type="reset" class="btn btn-default">やり直す</button>
                          <button type="submit" class="btn btn-primary">登録</button>
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
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
