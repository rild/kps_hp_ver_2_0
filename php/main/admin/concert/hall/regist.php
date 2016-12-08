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
                      <li class="active">Regist</li>
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
<div class="col-lg-8">
  <div class="well bs-component">
    <form class="form-horizontal" action="regist_func.php" method="post">
      <fieldset>
        <legend>会場登録</legend>
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
if ($err_return == $err_list["duplicate"]) {
echo <<<EOM
<div class="form-group has-error">
  <label for="hallID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="hallID" name="hall_id">
    <span class="help-block">IDが重複しています。</span>
  </div>
</div>
<div class="form-group">
  <label for="hallName" class="col-lg-2 control-label">会場名*</label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="hallName" name="hall_name">
  </div>
</div>
<div class="form-group">
  <label for="hallAdress" class="col-lg-2 control-label">住所</label>
  <div class="col-lg-10">
    <textarea class="form-control" rows="3" id="hallAdress" name="hall_address"></textarea>
    <span class="help-block">会場の住所として表示される部分になります。</span>
  </div>
</div>
EOM;
}
else if ($err_return == $err_list["link_directly"]) {
echo <<<EOM
<div class="form-group　has-warning">
  <label for="hallID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="hallID" name="hall_id">
    <span class="help-block">必要な情報を入力してください。</span>
  </div>
</div>
<div class="form-group　has-warning">
  <label for="hallName" class="col-lg-2 control-label">会場名*</label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="hallName" name="hall_name">
    <span class="help-block">必要な情報を入力してください。</span>
  </div>
</div>
<div class="form-group　has-warning">
  <label for="hallAdress" class="col-lg-2 control-label">住所</label>
  <div class="col-lg-10">
    <textarea class="form-control" rows="3" id="hallAdress" name="hall_address"></textarea>
    <span class="help-block">会場の住所として表示される部分になります。</span>
  </div>
</div>
EOM;
}
else {
echo <<<EOM
<div class="form-group">
  <label for="hallID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="hallID" name="hall_id">
    <span class="help-block">既に登録された会場と重複した場合はエラーになります。</span>
  </div>
</div>
<div class="form-group">
  <label for="hallName" class="col-lg-2 control-label">会場名*</label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="hallName" name="hall_name">
  </div>
</div>
<div class="form-group">
  <label for="hallAdress" class="col-lg-2 control-label">住所</label>
  <div class="col-lg-10">
    <textarea class="form-control" rows="3" id="hallAdress" name="hall_address"></textarea>
    <span class="help-block">会場の住所として表示される部分になります。</span>
  </div>
</div>
EOM;
}
?>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">リセット</button>
            <button type="submit" class="btn btn-primary">登録</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
            </div>   <!-- row end -->
          </div>

      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../../../js/bootstrap.min.js"></script>

</body>
</html>
