<?php
$conn = pg_connect ("host=localhost dbname=j140098t user=j140098t");
$query = "INSERT INTO member (login_name,password) VALUES($1, $2)";

$result = pg_prepare ($conn, "my_query", $query);
$result = pg_execute ($conn, "my_query", array("{$_POST['login_name']}","{$_POST['password']}")); ?>
