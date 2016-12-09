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
      include('../../fragment/sidebar_member_admin.php');
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
                      <h1>ユーザアカウントを新規に登録する</h1>
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
                        <legend>ユーザ情報の入力</legend>
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
  <label for="memberID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="memberID" name="member_id">
    <span class="help-block">既に登録されたIDです。</span>
  </div>
</div>
EOM;
}
else {
echo <<<EOM
<div class="form-group">
  <label for="memberID" class="col-lg-2 control-label">ID*</label>
  <div class="col-lg-10">
    <input type="number" class="form-control" id="memberID" name="member_id">
    <span class="help-block">既に登録された値と重複した場合はエラーになります。</span>
  </div>
</div>
EOM;
}

echo <<<EOM
<div class="form-group">
  <label for="concertName" class="col-lg-2 control-label">ログインID</label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="concertName" name="member_login_id">
  </div>
</div>
<div class="form-group">
  <label for="memberPass" class="col-lg-2 control-label">パスワード</label>
  <div class="col-lg-10">
    <input type="password" class="form-control" id="memberPass" name="member_passw">
  </div>
</div>
<div class="form-group">
  <label for="memberPassConf" class="col-lg-2 control-label">パスワード</label>
  <div class="col-lg-10">
    <input type="password" class="form-control" id="memberPassConf" name="member_passw_conf">
    <span class="help-block">入力確認用。</span>
  </div>
</div>
<div class="form-group">
  <label for="memberName" class="col-lg-2 control-label">氏名 <small>(任意)</small></label>
  <div class="col-lg-10">
    <input type="text" class="form-control" id="memberName" name="member_name">
  </div>
</div>
EOM;
echo <<<EOM
 <div class="form-group">
  <label for="memberBirthday" class="col-lg-2 control-label">誕生日 <small>(任意)</small></label>
  <div class="col-lg-10">
    <select class="form-control" size="1" id="memberBirthday" name="member_birthday_day">
EOM;
for ($i = 0; $i <= 31; $i++) {
  if ($i == 0) {
    print "<option></option>";
  }
  else {
echo <<< EOD
                    <option>$i</option>
EOD;
  }
}
echo <<<EOM
    </select>
    <span class="help-block">日</span>
   <select class="form-control" size="1" id="memberBirthday" name="member_birthday_month">
EOM;
for ($i = 0; $i <= 12; $i++) {
  if ($i == 0) {
    echo '<option></option>';
  }
  else {
echo <<< EOD
          <option>$i</option>
EOD;
  }
}
echo <<<EOM
   </select>
   <span class="help-block">月</span>
   <select class="form-control" size="1" id="memberBirthday" name="member_birthday_year">
EOM;
for ($i = 1970; $i <= 2050; $i++) {
echo <<< EOD
<option>$i</option>
EOD;
}
echo <<<EOM
   </select>
   <span class="help-block">年</span>
 </div>
</div>
EOM;

?>
                        <div class="form-group">
                           <label for="memberEmail" class="col-lg-2 control-label">
                             Email <small>(任意)</small></label>
                           <div class="col-lg-10">
                             <input type="text" class="form-control" id="memberEmail" placeholder="Email"
                             name="member_mail_address">
                           </div>
                        </div>
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
  <script src="../../../../js/bootstrap.min.js"></script>

</body>
</html>
