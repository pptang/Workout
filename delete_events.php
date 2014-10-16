<?php
$id = $_POST['id'];
include("mysql.inc.php");

$sql = "DELETE FROM evenement WHERE id = '$id'";
$result=mysql_query($sql);
?>