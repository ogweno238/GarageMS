<?php
	include('connect.php');
	$ieckid=$_GET['ieckid'];
	$results = $db->prepare("SELECT * FROM election_team WHERE ieckid= :ieckid");
	$results->bindParam(':ieckid', $ieckid);
	$results->execute();
	for($i=0; $rows = $results->fetch(); $i++){
?>
<form action="editteammemberexec.php" method="post">
<input type="hidden" name="memids" value="<?php echo $ieckid; ?>" />
Team Name<br>
<select name="team">
<option><?php echo $rows['eln_name']; ?></option>
<?php
	include('connect.php');
	$result = $db->prepare("SELECT * FROM election_team");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<option><?php echo $row['eln_name']; ?></option>
<?php
}
?>
</select><br>
Team Member<br>
<textarea name="member"><?php echo $rows['eln_leader']; ?></textarea><br>
<input type="submit" value="Save">
</form>
<?php
}
?>