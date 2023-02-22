<?php
session_start();
include('dbconnect.php');
$mm = $_POST['name'];
$ss = $_POST['leader'];
// query
$sql = "INSERT INTO election_team (eln_name,eln_leader) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$mm,':b'=>$ss));
header("location: team.php");


?>