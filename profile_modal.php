
<!-- modal -->

<div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    </div>
    <div class="modal-body">

        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Update Profile!</strong>&nbsp;Please Enter the Details Below.
        </div>
        	<?php
		include('dbcon.php');
		if (isset($_POST['submit'])){
		$usermail=$_POST['usermail'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
	
			$query=mysql_query("select * from employee where usermail='$usermail'")or die(mysql_error());
$count=mysql_num_rows($query);

if ($count  > 0){
	
$exist = "";
}else{
?>
<script>alert('Email Not found!');
            window.location.href = "dashboard_mail.php";</script>
<?php
}
								
			if($cpassword!=$password){
		$a="Password do not Match";
		}else{
		$a = "";
		}
	}
	?>
<form method="post" enctype="multipart/form-data">	
	<div class="span5">
	<div class="form-horizontal">
				<div class="control-group">
			<label class="control-label" for="inputEmail">Email:</label>
			<div class="controls">
			<input type="text" id="inputEmail" name="usermail" value="<?php if (isset($_POST['submit'])){echo $usermail;} ?>" placeholder="email" required>
				&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
	<?php if (isset($_POST['submit'])){?> 	<span class="label label-important"><?php echo $exist; ?></span><?php }?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			<input type="password" name="password" value="<?php if (isset($_POST['submit'])){echo $password;} ?>" placeholder="Password">
			</div>
		</div>
			<div class="control-group">
			<label class="control-label" for="inputPassword">Confirm Password</label>
			<div class="controls">
			<input type="password" name="cpassword" value="<?php if (isset($_POST['submit'])){echo $cpassword;} ?>" placeholder="Confirm Password" required>
					<?php if (isset($_POST['submit'])){?> 	<span class="label label-important"><?php echo $a; ?></span><?php }?>
			</div>

		</div>
 <div class="control-group">
                                    <label class="control-label" for="input01">Image:</label>
                                    <div class="controls">
                                        <input type="file" name="image" class="font" required> 
                                    </div>
                                </div>
		<div class="control-group">
			<div class="controls">
			<button name="submit" type="submit" class="btn btn-info" style="width:120px;"><i class="icon-large">&nbsp;</i>update Profile</button>
			</div>
		</div>
    </div>
</div>
	
	
	<div class="span6">
	
	
	<div class="form-horizontal">

	<?php 

if(isset($_POST['submit']))
{

		$usermail=$_POST['usermail'];

		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
	
		      $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);

                                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/employees/" . $_FILES["image"]["name"]);
                                $location = "uploads/employees/" . $_FILES["image"]["name"];
								

if($password == $cpassword && $count == 1){ ?>
<?php  
mysql_query("update employee set password = '$password' , location = '$location' , status = 'active' where usermail = '$usermail' ")or die(mysql_error());
?>
<script>alert('profile updated!');
            window.location.href = "dashboard_mail.php";</script>

<?php
}else{
echo " ";
}}
?>
  
	
		 
	
	

		
		
	</div>
		
		</div>	

	
</form>


        <!-- teacher -->




    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign icon-large"></i>&nbsp;Close</button>

    </div>
</div

><!-- end modal -->

						