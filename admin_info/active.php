<?php
	include('dbconn.php');
	$employee_id=$_GET['employee_id'];
	$result = $db->prepare("UPDATE employee SET status='active' WHERE employee_id= :memid");
	$result->bindParam(':memid', $employee_id);
	$result->execute();
	?>
	<script>alert('Email Account was Succefully unblocked');
            window.location.href = "home.php";</script>
 <?php
?>