<?php include('header_emails.php'); ?>
<?php include('auth.php'); ?>
<?php include('navbar_emails.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
                                    
                                    <strong>Create Employee Account</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li class="active"><a href="home.php">Home</a></li>
										<li><a href="employees.php">Employees</a></li>
                                        <li><a href="backup/import.php">Restore</a></li>
                                        <li><a href="backup/export.php">Backup</a></li>
										<li><a href="logout.php">Logout</a></li>
									 <script src="validation.js"></script></ul>
						<!--  -->
						 	<form name="form1" method="post">
                  
                  <p><strong>Create  email account </strong> - Add New </p>
                 <table class="form"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                     
                      <td>&nbsp;&nbsp;Fast Name </td>
                      <td><input name="firstname" placeholder="firstname" style="display: block;height: 25px;padding: 6px 12px;font-size: 12px;width:230px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;
    border-radius: 4px;" type="text" id="firstname" maxlength="30"   class="round default-width-input" style="width:200px;" /></td>
                      <script type="text/javascript">
				    var f1 = new LiveValidation('firstname');
				    f1.add(Validate.Presence,{failureMessage: " Please enter firstname"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z\s]+$/i ,failureMessage:" It allows only characters"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z][a-zA-Z\s]{0,}$/,failureMessage: 
					       " Invalid firstname"});
				 </script>
                    </tr><tr>
                    <td>&nbsp;&nbsp;Last Name</td>
                      <td><input name="lastname" style="display: block;width:25px;padding: 6px 12px;font-size: 12px;width:230px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;
    border-radius: 4px;" placeholder="secondname"type="text" id="lastname" maxlength="30" class="round default-width-input" /></td>
                      <script type="text/javascript">
				    var f1 = new LiveValidation('lastname');
				    f1.add(Validate.Presence,{failureMessage: " Please enter lastname"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z\s]+$/i ,failureMessage:" It allows only characters"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z][a-zA-Z\s]{0,}$/,failureMessage: 
					       " Invalid lastname"});
				 </script></tr><tr>
                        <td>&nbsp;&nbsp;Email-Id </td>
                      <td><input name="usermail" placeholder="email" style="display: block;height: 25px;padding: 6px 12px;font-size: 12px;width:230px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;
    border-radius: 4px;" type="text" id="email_id" maxlength="35"  class="round default-width-input" /></td>
                      <script type="text/javascript">
				    var f1 = new LiveValidation('email_id');
				    f1.add(Validate.Presence,{failureMessage: " Please enter email-id"});
				    f1.add( Validate.Email );
				 </script></tr>
                  <td>&nbsp;&nbsp;username</td>
                      <td><input name="username" style="display: block;width:25px;padding: 6px 12px;font-size: 12px;width:230px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;
    border-radius: 4px;" placeholder="username"type="text" id="username" maxlength="30" class="round default-width-input" /></td>
                      <script type="text/javascript">
				    var f1 = new LiveValidation('username');
				    f1.add(Validate.Presence,{failureMessage: " Please enter username"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z\s]+$/i ,failureMessage:" It allows only characters"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z][a-zA-Z\s]{0,}$/,failureMessage: 
					       " Invalid username"});
				 </script></tr><tr><tr>
                      <td>&nbsp;&nbsp;Password</td>
                      <td><input name="password" placeholder="password" type="password" style="display: block;width: 100%;height: 25px;padding: 6px 12px;font-size: 12px;width:230px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;
    border-radius: 4px;" id="password" maxlength="10"   class="round default-width-input" /></td>
                      <script type="text/javascript">
				    var f1 = new LiveValidation('password');
				   f1.add(Validate.Presence,{failureMessage: " It cannot be empty"});
				   f1.add(Validate.Format,{pattern: /^[0-9]+$/ ,failureMessage: " It allows only numbers"});
				   f1.add( Validate.Length, { minimum: 6, maximum: 10 } );
				 </script>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <input type="hidden" name="location" value="uploads/employees/images.jpg">
                   
                  <td></td>
                  <td><div class="col-md-8" style="float:right; margin-bottom:10px;">
                   <input  class="btn btn-primary" type="submit" name="btn-signup" value="Create">
                     </div></td>
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form>
						
					<?php

include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$usermail= mysql_real_escape_string($_POST['usermail']);
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$location = mysql_real_escape_string($_POST['location']);
	
	
	$firstname = trim($firstname);
	$lastname = trim($lastname);
	$usermail = trim($usermail);
	$username = trim($username);
	$password = trim($password);
	$location = trim($location);
	
	// email exist or not
	$query = "SELECT usermail FROM employee WHERE usermail='$usermail'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0){
		
		if(mysql_query("INSERT INTO employee(firstname,lastname,usermail,username,password,location) VALUES('$firstname','$lastname','$usermail','$username','$password','$location')"))
		{
			?>
            <script>alert('successfully created email account');
            window.location.href = "employees.php";</script>

			<?php
		}
		else
		{
			?>
			<script>alert('error while creating email ');</script>
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
