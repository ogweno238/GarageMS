<?php
include('includes/dbconfig.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$national_id=$_POST['national_id'];
	$password=$_POST['password'];
	
	$query=mysqli_query($con,"insert into profile(name,email,contact,national_id)
	values('$name','$email','$contact','$national_id')");
	
	$sql=mysqli_query($con,"insert into login(email,password,status)
	values('$email','$password','1')");
	$msg="Registration successfull. Now You can login !";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>REVOLUTIONARY ONLINE GARAGE SYSTEM </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    	
<script>
function emailAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_email.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status2").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
	<h3 align="center" style="color:#fff"><a href="index.php" style="color:#fff">REVOLUTIONARY ONLINE GARAGE SYSTEM 
</a></h3>
	<hr />
		      <form class="form-login" method="post">
		        <h2 class="form-login-heading">User Registration</h2>
		        <p style="padding-left: 1%; color: green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?>


		        </p>
		        <div class="login-wrap">
		         <input type="text" class="form-control" placeholder="Full Name" name="name" required="required" autofocus  
				 onkeypress="return /[a-z]/i.test(event.key)">
		            <br>
		            
					 <input type="email" class="form-control" placeholder="Email" name="email" id="email" pattern=".+@gmail\.com" onBlur="emailAvailability()"  required="required">
					  <span id="user-availability-status2" style="font-size:12px;"></span>
		            <br>
					 <input type="number" maxlength="10" class="form-control" name="contact" placeholder="Contact" required="required">
		            <br>
					 <input type="number" class="form-control" name="national_id" placeholder="National ID" required="required">
		            <br>
		            <input type="password" class="form-control" placeholder="password" required="required" name="password"><br >
		            
					
										<input type="hidden" class="form-control" maxlength="10" name="date_time" 
										placeholder="<?php echo date('Y-m-d H:i:s');?>" required="required"  value="<?php echo date('Y-m-d H:i:s');?>" autofocus>
		            <br>
					
		           
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
		            <hr>
		            
		            <div class="registration">
		                Already Registered<br/>
		                <a class="" href="login.php">
		                   Sign in
		                </a>
		            </div>
		
		        </div>
		
		      
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
