<?php
	include('dbconn.php');
	$servicedetails_id=$_GET['servicedetails_id'];
	$result = $db->prepare("UPDATE servicedetails SET service_status='Accepted' WHERE servicedetails_id= :memid");
	$result->bindParam(':memid', $servicedetails_id);
	$result->execute();
	?>
	<script>alert('succefully accepted!');
            window.location.href = "dashboard.php";</script>

<?php
	
?>