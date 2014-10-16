<?php
session_start();
header("content-type:text/html;charset=UTF-8");
$uid=$_SESSION['Uid'];

// List of events
$json = array();

 // Query that retrieves events
 $requete = "SELECT * FROM evenement WHERE Uid = $uid";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=sql301.lionfree.net;dbname=lfnet_14067771_workout', 'lfnet_14067771', 'bible518');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
 
?>