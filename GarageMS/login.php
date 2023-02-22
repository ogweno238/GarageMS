<?php 
	//Start session
	session_start();
	include("conn.php");
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['uname']);
	$password = clean($_POST['pword']);
	//Create query
	$qry="SELECT * FROM login WHERE email='$login' AND password='$password'";
	$result=mysql_query($qry);
	//while($row = mysql_fetch_array($result))
//  {
//  $level=$row['position'];
//  }
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = "TRUE";
			$_SESSION['Admin_Logon'] = $member['email'];
			$_SESSION['Admin_UserLogon'] = $member['email'];
			$_SESSION['Admin_UserLevel'] = $member['status'];
			session_write_close();
if(!session_id()) session_start(); 
switch($_SESSION['Admin_UserLevel']) { 
case "1": 
header("Location: garage_dashboard.php"); 
break; 
} 
	exit();
		}else {
			//Login failed
			$endTime = date('H:i:s');
			mysql_query("UPDATE falied SET attempt=attempt+1, time='$endTime'");
			header("location: index.php");
			
			exit();
		}
	}else {
		?> 
<script>alert('Request was Successful!')
            window.location.href = "index.php";</script>;
<?php


}  
?>