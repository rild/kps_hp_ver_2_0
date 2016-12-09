<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;

$path = "php/main/admin/member/";

$sidebar = 0;
$sidebar_list = array(
    "home" => 0,
    "all" => 1,
    "search" => 2,
    "regist" => 3,
    "delete" => 4,
);

if(isset($_GET['sidebar'])) {
  $sidebar = $_GET['sidebar'];
}

// <----- CHECK query
if ($sidebar != $sidebar_list["home"] &&
$sidebar != $sidebar_list["all"] &&
// $sidebar != $sidebar_list["search"] &&
$sidebar != $sidebar_list["regist"] &&
$sidebar != $sidebar_list["delete"]
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

// all 1
$url = $endpoint.$path."all.php?sidebar=".$sidebar_list["all"];
if ($sidebar == $sidebar_list["all"]) {
echo <<<EOM
<li class="active"><a href="{$url}">一覧</a></li>
EOM;
} else {
echo <<<EOM
<li><a href="{$url}">一覧</a></li>
EOM;
}

// // search 2
// $url = $endpoint.$path."search.php?sidebar=".$sidebar_list["search"];
// if ($sidebar == $sidebar_list["search"]) {
// echo <<<EOM
// <li class="active"><a href="{$url}">検索</a></li>
// EOM;
// } else {
// echo <<<EOM
// <li><a href="{$url}">検索</a></li>
// EOM;
// }

// regist 3
$url = $endpoint.$path."regist.php?sidebar=".$sidebar_list["regist"];
if ($sidebar == $sidebar_list["regist"]) {
echo <<<EOM
<li class="active"><a href="{$url}">登録</a></li>
EOM;
} else {
echo <<<EOM
<li><a href="{$url}">登録</a></li>
EOM;
}

// delete 4
$url = $endpoint.$path."delete.php?sidebar=".$sidebar_list["delete"];
if ($sidebar == $sidebar_list["delete"]) {
echo <<<EOM
<li class="active"><a href="{$url}">削除</a></li>
EOM;
} else {
echo <<<EOM
<li><a href="{$url}">削除</a></li>
EOM;
}

echo <<<EOM
  </ul>
</div>
EOM;
?>
