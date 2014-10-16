<?php
header("content-type:text/html;charset=UTF-8");
session_start();
include("mysql.inc.php");
foreach($_POST['yes'] as $value){
	$sql_if = "UPDATE friend SET status='1' WHERE friendid='{$value}' && myname='{$_SESSION['Uname']}'";
	mysql_query($sql_if);
	$sql = "UPDATE friend SET status='1' WHERE friend='{$_SESSION['Uname']}' && Uid='{$value}'";
	$result = mysql_query($sql);
}
header("Location: main.php");
?>