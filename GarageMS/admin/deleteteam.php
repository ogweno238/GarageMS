<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM election_team WHERE ieckid= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>