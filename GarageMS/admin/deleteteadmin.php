<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM admin WHERE power!='1' AND user_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>