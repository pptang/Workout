<?php
session_start();
//Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$url = $_POST['url'];
$uid = $_SESSION['Uid'];
//conncection to the database
include("mysql.inc.php");

//insert the records
$sql = "INSERT INTO evenement (title, start, end, url, uid) VALUES ('$title', '$start', '$end','$url', '$uid')";
$result = mysql_query($sql);
?>