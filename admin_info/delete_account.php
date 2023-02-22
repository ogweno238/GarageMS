<?php
	include('dbconn.php');
	$profile_id=$_GET['profile_id'];
	$result = $db->prepare("DELETE FROM profile  WHERE profile_id= :memid");
	$result->bindParam(':memid', $profile_id);
	$result->execute();
	?>
	<script>alert('succefully deleted!');
            window.location.href = "employees.php";</script>

<?php
	
?>