<!-- TODO クエリでページ移動 GET -->

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
          <li><a href="top.php">ホーム</a></li>
          <li><a href="all.php">一覧</a></li>
          <li><a href="search.php">検索</a></li>
          <li><a href="regist.php">登録</a></li>
          <li class="active"><a href="delete.php">削除</a></li>
          <li class="disabled"><a href="#">Disabled</a></li>
        </ul>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <h1>登録された演奏会の削除</h1>
                  </div>
              </div>
          </div>

          <div class="bs-component">
            <form class="form-horizontal">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th></th>
                  <th>#</th>
                  <th>Column heading</th>
                  <th>Column heading</th>
                  <th>Column heading</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>1</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                </tr>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>2</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                </tr>
                <tr class="info">
                  <td><input type="checkbox"></td>
                  <td>3</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                </tr>
                <tr class="success">
                  <td><input type="checkbox"></td>
                  <td>4</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                </tr>
              </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Submit</button>

            </form>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <p class="bs-component">
                <a href="#" class="btn btn-default">Default</a>
              </p>
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
