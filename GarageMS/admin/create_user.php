 <?php
session_start();
include("config.php");
$studid = $_POST['studid'];
$leve = $_POST['leve'];
$name = $_POST['name'];


$course =$_POST['course'];
$year = $_POST['year'];
$sec = $_POST['sec'];

$password=$_POST['password'];
$rpassword=$_POST['rpassword'];

if($password == $rpassword)
{
										  
	$insertloginQuery = "insert into login(studid,password,date_registereddatetime) 
	                                   values ('".$studid."','".$password."',now())";
   
	$insertQuery = "insert into students(studid,password,leve,name,course,year,
	                                       sec)
											values('".$studid."','".$password."','".$leve."',
									               '".$name."','".$course."','".$year."',
											      '".$sec."')";
	
	$sql1 = "select studid from students where studid = '$studid'";
    $result1 = mysql_query($sql1) or die ("Couldn't execute query.");										  
    
	$num1=mysql_num_rows($result1);
	
	if($num1 == 1)
	{
		?>
            <script>alert('Sorry Email already Exist !');
            window.location.href = "index.php";</script> 
			<?php 
	}
	else
	{
		
		
		if((mysql_query($insertloginQuery)) && (mysql_query($insertQuery)))
		  {
			?>
            <script>alert('Registered Successfully');
            window.location.href = "index.php";</script> 
			<?php 	  
		   }
		else
		 {
			?>
            <script>alert('Registration Failed');
            window.location.href = "index.php";</script> 
			<?php 
		  }
       }
	 }    
else
 {
   echo "Error:Password missmatch";
  }
?>