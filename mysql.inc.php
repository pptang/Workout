<?php
header("content-type:text/html;charset=UTF-8");
$dbServer = "sql301.lionfree.net";
$dbName = "lfnet_14067771_workout";
$dbUserName = "lfnet_14067771";
$dbPassword = "bible518";
if(!@mysql_connect($dbServer , $dbUserName , $dbPassword)){
	die("fuck!");
}
mysql_query("SET NAMES utf8");
if(!@mysql_select_db($dbName)){
	die("Fail to select DB!");
}
?>
