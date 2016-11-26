<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>メンバーログインページ</title>

  <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/rild.css">
</head>

<body>
  <header>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <!-- TOFIX end point -->
          <!-- <a href="/kps_honoka/" class="navbar-brand">KPS</a> -->
          <a href="../../../" class="navbar-brand">KPS</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="/">Help</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>



  <section class="section section-default">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>ログインIDとパスワードを入力してください</h1>
          <p>Sign in to Members' Page</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>アカウントを持っていない場合は <a href="//github.com/windyakin/Honoka#readme">README</a> または <a href="//github.com/windyakin/Honoka/wiki">Wiki</a> をご確認ください</p>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="bs-docs-section">
      <div class="well bs-component">
        <div class="row">
          <div class="col-lg-12">

          <form method="POST" action="./login_check.php">
            <fieldset>
              <legend>Input Form</legend>

              <div class="form-group">
                <label for="input_id" class="col-lg-2 control-label">ID / E-mail</label>
                <div class="col-lg-10">
                  <input type="text" id="input_id" name="login_name" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label for="input_password" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                  <input type="password" id="input_password" name="login_password" class="form-control">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Checkbox
                    </label>
                  </div>
                </div>
              </div>

              <div class="center-block">
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" value="OK">ログイン</button>
                </div>
              </div>

            </fieldset>
          </form>

          <div class="container-fluid">
            <p class="text-right"><a href="#" class="btn btn-link">パスワードを忘れた場合</a></p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php
  $login_failed = 0;
  if (isset($_GET['no'])) {
    $login_failed = $_GET['no'];
  }


  if ($login_failed==1) {
    // 不正なIDまたはパスワード
    echo '<div class="bs-docs-section">
      <div class="bs-component">
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          ログインに失敗しました。 <strong> ログインID (メールアドレス) </strong> または, <strong>パスワード</strong>が違います。<a href="#" class="alert-link">Try again</a>
        </div>
      </div>
    </div>';
  } else if ($login_failed==2) {
    // どちらかの入力がない
    echo '<div class="bs-docs-section">
      <div class="bs-component">
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong> ログインID (メールアドレス) </strong> と, <strong>パスワード</strong>を入力してください。
        </div>
      </div>
    </div>';
  }
  ?>
  <!-- phpスクリプト内で実行 -->
  <!-- <div class="bs-docs-section">
    <div class="bs-component">
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        ログインに失敗しました。 <strong> ログインID (メールアドレス) </strong> または, <strong>パスワード</strong>が違います。<a href="#" class="alert-link">Try again</a>
      </div>
    </div>
  </div> -->

  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
