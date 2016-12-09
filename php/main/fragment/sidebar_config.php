<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;

$path = "php/main/config/";

$sidebar = 0;
$sidebar_list = array(
    "home" => 0,
    "account" => 1,
    "update" => 2,
    "password" => 3,
);

if(isset($_GET['sidebar'])) {
  $sidebar = $_GET['sidebar'];
}

// <----- CHECK query
if ($sidebar != $sidebar_list["home"] &&
// $sidebar != $sidebar_list["account"] &&
// $sidebar != $sidebar_list["update"] &&
$sidebar != $sidebar_list["password"]
) $sidebar = 0;
// <----- CHECK END

echo <<<EOM
<div id="sidebar-wrapper">
  <ul class="nav nav-pills nav-stacked">
EOM;

// home 0
$url = $endpoint.$path."top.php";
if ($sidebar == $sidebar_list["home"]) {
echo <<<EOM
<li class="active"><a href="{$url}">ホーム</a></li>
EOM;
} else {
echo <<<EOM
<li><a href="{$url}">ホーム</a></li>
EOM;
}

// // account 1
// $url = $endpoint.$path."account.php?sidebar=".$sidebar_list["account"];
// if ($sidebar == $sidebar_list["account"]) {
// echo <<<EOM
// <li class="active"><a href="{$url}">アカウント</a></li>
// EOM;
// } else {
// echo <<<EOM
// <li><a href="{$url}">アカウント</a></li>
// EOM;
// }

// // update 2
// $url = $endpoint.$path."update.php?sidebar=".$sidebar_list["update"];
// if ($sidebar == $sidebar_list["update"]) {
// echo <<<EOM
// <li class="active"><a href="{$url}">更新</a></li>
// EOM;
// } else {
// echo <<<EOM
// <li><a href="{$url}">更新</a></li>
// EOM;
// }

// password 3
$url = $endpoint.$path."password.php?sidebar=".$sidebar_list["password"];
if ($sidebar == $sidebar_list["password"]) {
echo <<<EOM
<li class="active"><a href="{$url}">パスワードの更新</a></li>
EOM;
} else {
echo <<<EOM
<li><a href="{$url}">パスワードの更新</a></li>
EOM;
}

echo <<<EOM
  </ul>
</div>
EOM;
?>
