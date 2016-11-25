<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Keio Piano Society</title>

  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/rild.css">

  <style type="text/css">

  </style>

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<!-- like index.php -->
<body>


  <header>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../" class="navbar-brand">KPS</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="#">Top</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <!-- general -->
                <li><a href="#">Blog</a></li>
                <li><a href="#">Portfolio</a></li>
                <!-- admin -->
                <li class="divider"></li>
                <li><a href="#">Concert</a></li>
                <li><a href="#">Member</a></li>
                <li><a href="#">Article</a></li>
                <!-- user config -->
                <li class="divider"></li>
                <li><a href="#">User Config</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </li>
          </ul>
          <!-- search -->
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../php/users/signin/login.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <section class="section section-default">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>ようこそ</h1>
          <p>最新の更新</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>アカウントを持っていない場合は <a href="//github.com/windyakin/Honoka#readme">README</a> または <a href="//github.com/windyakin/Honoka/wiki">Wiki</a> をご確認ください</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-default">
  <div class="container">
    <h1>メニュー</h1>
    <a href="search.php">イベント検索</a><br>
    <a href="list.php">イベント一覧</a><br>
    <a href="create.php">イベント作成</a><br>
    <a href="password.php">パスワード変更</a><br>
    <a href="logout.php">ログアウト</a><br>
  </div>
  </section>

  <footer class="small">
  </footer>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>

</body>
</html>
