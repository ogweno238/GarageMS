<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5(mysql_real_escape_string($_POST['password']));
	
	$username = trim($username);
	$email = trim($email);
	$password = trim($password);
	
	// email exist or not
	$query = "SELECT email FROM admin WHERE email='$email'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0){
		
		if(mysql_query("INSERT INTO admin(username,email,password) VALUES('$username','$email','$password')"))
		{
			?>
			<script>alert('successfully registered ');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php
		}		
	}
	else{
			?>
			<script>alert('Sorry Email ID already taken ...');</script>
			<?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>online_guarage</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body bgcolor="white">
<center>
<br /><br />
<br /><br />
<img src="img/logo.jpg" width="200" height="90" />
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="username" placeholder="Username" required /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="Email" required /></td>
</tr>
<tr>
<td><input type="password" name="password" placeholder="Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</div>

  
</tr>
<tr>
<td><a href="login.php"><b><font size="+1">Click Here to Sign In </font></b></a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>