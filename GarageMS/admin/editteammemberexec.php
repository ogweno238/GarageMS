<?php
// configuration
include('connect.php');

// new data
$id = $_POST['memids'];
$mm = $_POST['team'];
$ss = $_POST['member'];
// query
$sql = "UPDATE election_team 
        SET eln_name=?, eln_leader=?
		WHERE ieckid=?";
$q = $db->prepare($sql);
$q->execute(array($mm,$ss,$id));
header("location: teammember.php");

?>