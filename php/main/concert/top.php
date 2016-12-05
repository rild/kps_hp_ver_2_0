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
      <div id="sidebar-wrapper">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="top.php">ホーム</a></li>
          <li><a href="all.php">一覧</a></li>
          <li><a href="search.php">検索</a></li>
          <li><a href="regist.php">登録</a></li>
          <li><a href="delete.php">削除</a></li>
          <li class="disabled"><a href="#">Disabled</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

          <div class="container-fluid">

              <div class="row">
                  <div class="col-lg-12">
                    <div class="page-header">
                      <h1 id="type">Concert</h1>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <blockquote>
                     <p>ConcertのTopページ。左のサイドニューから選択をしてください。</p>
                     <small>Concert > Top にはサイトの更新履歴などのログが表示されます。</small>
                   </blockquote>
                  </div>
              </div>
          </div>

          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="bs-component">
                  <p class="text-muted">サイトに登録されている演奏会</p>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="badge">14</span>
                      Concert all registed
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="bs-component">
                  <p class="text-muted">最新の演奏会情報</p>
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
                  <p class="text-muted">Concertページ更新履歴</p>
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
          <div>
      </div>
      <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</body>
</html>
