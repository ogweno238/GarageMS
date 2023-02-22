
<?php
	include('dbconn.php');
	$fir_ref=$_GET['fir_ref'];
	$result = $db->prepare("UPDATE fir_details SET status='confirmed' WHERE status='waiting' and fir_ref= :memid");
	$result->bindParam(':memid', $fir_ref);
	$result->execute();
	header('location: fir.php');
?>
