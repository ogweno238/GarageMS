	<?php
		include('dbcon.php');
		if (isset($_POST['submit'])){
		$student_no=$_POST['student_no'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
	
			$query=mysql_query("select * from member where student_no='$student_no'")or die(mysql_error());
$count=mysql_num_rows($query);

if ($count  > 0){
	
$exist = "";
}else{
$exist ='ID Number not Found!';
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
			<label class="control-label" for="inputEmail">Student No:</label>
			<div class="controls">
			<input type="text" id="inputEmail" name="student_no" value="<?php if (isset($_POST['submit'])){echo $student_no;} ?>" placeholder="Student No" required>
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
			<div class="controls">
			<button name="submit" type="submit" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Confirm</button>
			</div>
		</div>
    </div>
</div>
	
	
	<div class="span6">
	
	
	<div class="form-horizontal">

	<?php 

if(isset($_POST['submit']))
{

		$student_no=$_POST['student_no'];

		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
	
		      $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);

                                move_uploaded_file($_FILES["image"]["tmp_name"], "librarian/registrar/upload/" . $_FILES["image"]["name"]);
                                $location = "upload/" . $_FILES["image"]["name"];
								

if($password == $cpassword && $count == 1){ ?>
<?php  
mysql_query("update member set password = '$password' , photo = '$location' , status = 'active' where student_no = '$student_no' ")or die(mysql_error());
?>
<script type="text/javascript">
 window.location='success.php'; 
</script>
<?php
}else{
echo " ";
}}
?>
  
	
		  <div class="control-group">
                                    <label class="control-label" for="input01">Image:</label>
                                    <div class="controls">
                                        <input type="file" name="image" class="font" required> 
                                    </div>
                                </div>
	
	

		
		
	</div>
		
		</div>	

	
</form>