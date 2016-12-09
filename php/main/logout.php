<?php
session_start();
session_destroy();

$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/users/signin/";

$url = $endpoint.$path."login.php";
$return = 0;
header("Location: {$url}?return=".$return);
exit;

?>
