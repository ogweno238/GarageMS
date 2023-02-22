	<?php
	include('auth.php');
 	include('dbcon.php');
	
		$id=$_POST['selector'];
 	$profile_id  = $_POST['profile_id'];
	$due_date  = $_POST['due_date'];

	if ($id == '' ){ 
	header("location: garage_services.php");
	?>
	

	<?php }else{
	
	if(isset($_POST['submit'])){
		if(empty($_POST['selector']) || !isset($_POST['selector'])){
			die('Room required');
		}
		$query = "UPDATE profile SET checkout = 1 ";
		$res = mysql_query($query);	

	}
		$N = count($id);
for($i=0; $i < $N; $i++)
{
	mysql_query("update guarage set status='1' where guarage_id = '$id[$i]'")or die(mysql_error());	
}
	mysql_query("insert into tbl_service(profile_id,date_requested,due_date) values ('$profile_id',NOW(),'$due_date')")or die(mysql_error());
	$query = mysql_query("select * from tbl_service order by service_id DESC")or die(mysql_error());
	$row = mysql_fetch_array($query);
	$service_id  = $row['service_id']; 
	

$N = count($id);
for($i=0; $i < $N; $i++)
{
	 mysql_query("insert servicedetails(guarage_id,service_id,service_status) values('$id[$i]','$service_id','pending')")or die(mysql_error());

}
?> 
<script>alert('Request was Successful!')
            window.location.href = "garage_history.php";</script>;
<?php


}  
?>
	
	

	
	