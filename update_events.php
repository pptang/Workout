<?php
//connection to the database
include("mysql.inc.php");

/* Values received via ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$uid = $_SESSION['Uid'];

$select = "SELECT * FROM evenement WHERE id = '$id'";
$response = mysql_query($select);
if(mysql_num_rows($response)>0){
	//update the records
	$sql = "UPDATE evenement SET title='$title', start='$start', end='$end' WHERE id = '$id'";
	$result = mysql_query($sql);
}
else{
	//insert the records
	$sql = "INSERT INTO evenement (title, start, url, uid) VALUES ('$title', '$start', '$url', '$uid')";
	$result = mysql_query($sql);
}
?>