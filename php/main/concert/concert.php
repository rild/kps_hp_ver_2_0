<!-- 使ってない by rild-->

<html>
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
      <div id="sidebar-wrapper">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="page-header">
              <h4>Concert</h4>
            </div>
          </div>
          <div class="list-group">
            <a href="#" class="list-group-item active">一覧</a>
            <a href="#" class="list-group-item">検索</a>
            <a href="#" class="list-group-item">登録</a>
            <a href="#" class="list-group-item">削除</a>
          </div>
        </div>


      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <h1>すべての演奏会</h1>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="bs-component">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge">14</span>
                    Cras justo odio
                  </li>
                  <li class="list-group-item">
                    <span class="badge">2</span>
                    Dapibus ac facilisis in
                  </li>
                  <li class="list-group-item">
                    <span class="badge">1</span>
                    Morbi leo risus
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="bs-component">
                <div class="list-group">
                  <a href="#" class="list-group-item active">
                    Cras justo odio
                  </a>
                  <a href="#" class="list-group-item">Dapibus ac facilisis in
                  </a>
                  <a href="#" class="list-group-item">Morbi leo risus
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="bs-component">
                <div class="list-group">
                  <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  </a>
                  <a href="#" class="list-group-item">
                    <h4 class="list-group-item-heading">List group item heading</h4>
                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <section class="section section-default">
            <div class="container">
              <div class="row">
                <div class="col-xs-12 subtitle">
                  <h1>ようこそ</h1>
                  <p>最新の更新</p>
                </div>
              </div>

            </div>
          </section>

          <section class="section section-default">
          <div class="container">
            <h1>メニュー</h1>
            <a href="search.php">演奏会検索</a><br>
            <a href="list.php">演奏会一覧</a><br>
            <a href="create.php">演奏会登録</a><br>
            <a href="password.php">パスワード変更</a><br>
            <a href="logout.php">ログアウト</a><br>
          </div>
          </section>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
