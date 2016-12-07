<?php session_start(); ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>イベント管理サイト(仮) 演奏会管理</title>
</head>

<!-- like index.php -->
<body>
  <?php
  $creating_failed = 0;
  if (isset($_GET['no'])) {
    $creating_failed = $_GET['no'];
  }

if ($creating_failed==1 || $creating_failed == 2) {
    // どちらかの入力がない
echo <<<EOM
    <div class="bs-docs-section">
      <div class="bs-component">
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          フォームに必要な情報を入力してください。
        </div>
      </div>
    </div>
EOM;
} else if ($creating_failed==3) {
  // IDの重複
echo <<<EOM
  <div class="bs-docs-section">
    <div class="bs-component">
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        IDが重複しています。
      </div>
    </div>
  </div>
EOM;
}
  ?>

<form method="POST" action="./add_hall_func.php">
  <h1>会場情報の登録</h1>
  会場ID (重複なし)<br>
  <input type="number" name="hall_id">
  <br>
  会場名<br>
  <input type="text" name="hall_name">
  <br>
  住所<br>
  <!-- TODO hall一覧を取得 hall.name を一覧表示 post するのは hall.id -->
  <input type="text" name="hall_address">
  <br>

  <input type="submit" value="送信">
  <br>
</form>

</body>
</html>
