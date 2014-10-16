<?php
session_start();
header("content-type:text/html;charset=UTF-8");
include("mysql.inc.php");
$sql_if = "Update team SET status='1' WHERE Uid='{$_SESSION['Uid']}' && friendid='{$_POST['friend']}'";
mysql_query($sql_if);//剛好互相邀請
$sql = "Update team SET status='1' WHERE Uid='{$_POST['friend']}' && friendid='{$_SESSION['Uid']}'";
$result = mysql_query($sql);
if(mysql_affected_rows() > 0){
	//刪除friend欄位為自己的
	$sql_one = "DELETE FROM team WHERE friendid='{$_SESSION['Uid']}' && status='0'";
	$result = mysql_query($sql_one);
	//刪除myname欄位為自己的
	$sql_two = "DELETE FROM team WHERE Uid='{$_SESSION['Uid']}' && status='0'";
	$result = mysql_query($sql_two);
	//刪除myname欄位為邀請人的
	$sql_three = "DELETE FROM team WHERE Uid='{$_POST['friend']}' && status='0'";
	$result = mysql_query($sql_three);
	//刪除friend欄位為邀請人的
	$sql_four = "DELETE FROM team WHERE friendid='{$_POST['friend']}' && status='0'";
	$result = mysql_query($sql_four);
}
header("Location: main.php");
?>
