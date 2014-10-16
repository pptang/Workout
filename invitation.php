<?php
session_start();
include("mysql.inc.php");
if($_POST['response']=="accept"){
	echo $_SESSION['Uid'];
	$sql = "UPDATE invitation SET expired = 1 WHERE Mid = '{$_SESSION['Uid']}'";
	mysql_query($sql);
	//header("Location: main.php");
}
elseif($_POST['response']=="reject"){
	echo 'elseif';
	$sql = "UPDATE invitation SET expired = 2 WHERE Mid = '{$_SESSION['Uid']}'";
	mysql_query($sql);
	//header("Location: main.php");
}
else
	echo 'else';
	//header("Location: main.php");
?>