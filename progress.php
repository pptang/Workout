<?php
session_start();
include("mysql.inc.php");
$sql = "SELECT COUNT(Uid) AS num_event 
						  FROM evenement 
						  WHERE Uid = '{$_SESSION['Uid']}'";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);
	$num_event = $row[0];
	$_SESSION['progress'] = round((1-($num_event/$_SESSION['total_event'])) * 100); 
}
?>