<?php
	include('dbconnect.php');
	$ieckid=$_GET['ieckid'];
	$result = $db->prepare("SELECT * FROM election_team WHERE ieckid= :userid");
	$result->bindParam(':userid', $ieckid);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<form action="editteamexec.php" method="POST">
<input type="hidden" name="memids" value="<?php echo $ieckid; ?>" />
Team Name<br>
<input type="text" name="name" value="<?php echo $row['eln_name']; ?>" /><br>
Team Leader<br>
<input type="text" name="leader" value="<?php echo $row['eln_leader']; ?>" /><br>
<input type="submit" value="Save" />
</form>
<?php
	}
?>