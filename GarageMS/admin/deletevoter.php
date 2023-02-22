<?php
	include('../connect.php');
	$studid=$_GET['studid'];
	$result = $db->prepare("DELETE FROM students WHERE studid= :memid");
	$result->bindParam(':memid', $studid);
	$result->execute();
?>