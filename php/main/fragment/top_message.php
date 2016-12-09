<?php
// 戻り値がある時
if(isset($_GET['return']) && isset($_GET['from'])) {
  $return = $_GET['return'];
  $from = $_GET['from'];

// Password
  if ($from == "update_account_password") {
    if ($return == 0) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            正常にパスワードの更新が完了しました。
          </div>
      </div>
  </div>
EOM;
    }
  }
    // Concert
    else   if ($from == "create_concert") {
        if ($return == 0) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            演奏会情報が追加されました。
          </div>
      </div>
  </div>
EOM;
        }
      }
    else   if ($from == "delete_concert") {
        if ($return == 0) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            正常に演奏会情報の削除が完了しました。
          </div>
      </div>
  </div>
EOM;
        }
      }
    // Member
    else   if ($from == "create_member_account") {
        if ($return == 0) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            新規アカウントの登録が完了しました。
          </div>
      </div>
  </div>
EOM;
        }
      }
    else   if ($from == "delete_member_account") {
        if ($return == 0) {

echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            正常にアカウントのの更新が完了しました。
          </div>
      </div>
  </div>
EOM;
        }
  }
}

if (isset($_GET['no'])) {
  $err = $_GET['no'];
  $err_list = array(
      "link_directly" => 1,
      "db_connection" => 2,
      "duplicate" => 3,
      "nodata" => 4,
      "password_differ" => 5,
  );
  if ($err == $err_list["link_directly"]) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            必要な情報の入力が確認できませんでした。フォームにもう一度入力してください。
          </div>
      </div>
  </div>
EOM;
  }
  else if ($err == $err_list["db_connection"]) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            データベースの接続に失敗しました。しばらく時間を置いてもう一度お試しください。
          </div>
      </div>
  </div>
EOM;
  }
  else if ($err == $err_list["duplicate"]) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            IDが重複しています。別のIDをご使用ください。
          </div>
      </div>
  </div>
EOM;
  }
  else if ($err == $err_list["nodata"]) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            値が入力されていません。必要な情報を入力してください。
          </div>
      </div>
  </div>
EOM;
  }
  else if ($err == $err_list["password_differ"]) {
echo <<<EOM
  <div class="bs-docs-section">
      <div class="bs-component">
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            パスワードが違います。もう一度ご確認ください。
          </div>
      </div>
  </div>
EOM;
  }
}
?>
