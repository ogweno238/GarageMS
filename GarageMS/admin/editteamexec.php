<?php
// configuration
include('../connect.php');

// new data
$ieckid= $_POST['memids'];
$mm = $_POST['name'];
$ss = $_POST['leader'];
// query
$sql = "UPDATE election_team 
        SET eln_name=?, eln_leader=?
		WHERE ieckid=?";
$q = $db->prepare($sql);
$q->execute(array($mm,$ss,$ieckid));
header("location: team.php");

?>