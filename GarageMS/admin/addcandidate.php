<?php
	include('dbconnect.php');
	$studid=$_GET['studid'];
	$result = $db->prepare("SELECT * FROM students WHERE studid= :userid");
	$result->bindParam(':userid', $studid);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<form action="check_candidate.php" method="POST" enctype="multipart/form-data">
Candidate ID<br>
<input type="text" name="studid" value="<?php echo $studid; ?>" readonly="readonly" />
Candidate Name<br>
<input type="text" name="name" value="<?php echo $row['name']; ?>" readonly="readonly" /><br>
Course<br>
<input type="text" name="course" value="<?php echo $row['course']; ?>" readonly="readonly" /><br>
Year<br>
<input type="text" name="year" value="<?php echo $row['year']; ?>" readonly="readonly" /><br>
  <input type="file" name="myfile"> <br />
<select name="position" id="accom_id"> 
                    <option value="None">....Select Posirion....</option>
                    
                    <?php include'config.php'; $sql=mysql_query("SELECT * FROM `position`");
while($row=mysql_fetch_array($sql))
{
    ?>

			<option value="<?php echo $row['position'];?>"><?php echo $row['position'];?></option>
				
			
			</li>
			<?php } ?>   
                   
                  </select> <br />
                  <select name="platform" id="accom_id"> 
                    <option value="None">....Select Platform....</option>
                    
                    <?php include'config.php'; $sql=mysql_query("SELECT * FROM `d_ckets`");
while($row=mysql_fetch_array($sql))
{
    ?>

			<option value="<?php echo $row['docket'];?>"><?php echo $row['docket'];?></option>
				
			
			</li>
			<?php } ?>   
                   
                  </select> 
<input name="save" type="submit" value="Save" />
</form>
<?php
	}
?>