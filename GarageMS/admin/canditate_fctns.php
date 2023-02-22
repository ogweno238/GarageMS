<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Form</title>
		<link href="css/Add_Form.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="validation.js"></script>
</head>

<body bgcolor="#003300" background="../Iimg/gym-t2.jpg">
<div id="topbar">
    	<center><h1 style="color:#939">Register New Voters</h1>
    </div>
<div id="form">
 <div class="modal-body">
                            <form class="pb-modalreglog-form-reg" action="create_user.php" id="student" method="post" name="personal" onSubmit="return validateForm()">
                            
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" maxlength="20" class="form-control" id="first_name" name="studid" placeholder="Student ID" width="200">
                                       <script type="text/javascript">
				    var f1 = new LiveValidation('first_name');
				    f1.add(Validate.Presence,{failureMessage: " Please enter Studid"});
					f1.add( Validate.Length, { minimum: 8, maximum: 20 } );
				  </script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" name="name" id="last_name" placeholder="Full Name" width="200">
                                        <script type="text/javascript">
				    var f1 = new LiveValidation('last_name');
				    f1.add(Validate.Presence,{failureMessage: " Please enter fullname"});
				   f1.add(Validate.Format,{pattern: /^[a-zA-Z\s]+$/i ,failureMessage:" Only characters required"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z][a-zA-Z\s]{0,}$/,failureMessage: 
					       " Invalid Firstname"});
				 </script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                        <input type="hidden" value="4" class="form-control" name="leve" placeholder="Full Name" width="200">
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <select class="form-control" name="sec" id="sec">
                        	<option>..Sem / Stage..</option>
                            <?php
                            	$s=array("sem 1","sem 2","sem 3","sem 4");
								for($i=0;$i<count($s);$i++)
								{
									echo "<option>".$s[$i]."</option>";	
								}
                            ?>
                        </select>
                                                   <script type="text/javascript">
				    var f1 = new LiveValidation('sec');
				    f1.add(Validate.Presence,{failureMessage: "Please enter Sem"});				   
				 </script> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
                                        <input type="text" class="form-control" id="course" maxlength="20" name="course" placeholder="Course">
                                        <script type="text/javascript">
				    var f1 = new LiveValidation('course');
				    f1.add(Validate.Presence,{failureMessage: " Please enter Course"});
				   f1.add(Validate.Format,{pattern: /^[a-zA-Z\s]+$/i ,failureMessage:" Only characters required"});
				    f1.add(Validate.Format,{pattern: /^[a-zA-Z][a-zA-Z\s]{0,}$/,failureMessage: 
					       " Invalid Firstname"});
				 </script>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                <div class="input-group pb-modalreglog-input-group">
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-book"></span></span>
                                  <select class="form-control" name="year" id="year">
                        	<option>.....Year....</option>
                            <?php
                            	$s=array("1 Year","2 Year","3 Year","4 Year");
								for($i=0;$i<count($s);$i++)
								{
									echo "<option>".$s[$i]."</option>";	
								}
                            ?>
                        </select>
                                                   <script type="text/javascript">
				    var f1 = new LiveValidation('year');
				    f1.add(Validate.Presence,{failureMessage: "Please enter Year"});				   
				 </script> 
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                         <?php
 
           $password = "";
                   $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 
                    for($i = 0; $i < 8; $i++)
                           {
                         $random_int = mt_rand();
                     $password .= $charset[$random_int % strlen($charset)];
                   }
                
 ?>
                                        <input type="text" class="form-control" id="Reg_password" name="password" value="<?php echo $password, "\n"; ?>" readonly="readonly">
                                        <script type="text/javascript">
				    var f1 = new LiveValidation('Reg_password');
				   f1.add(Validate.Presence,{failureMessage: " Please enter password"});
				   f1.add( Validate.Length, { minimum: 5, maximum: 8 } );				   
				 </script> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        
                                        <input type="text" class="form-control" id="rpassword" name="rpassword" value="<?php echo $password, "\n"; ?>" readonly="readonly">
                                        <script type="text/javascript">
				    var f1 = new LiveValidation('rpassword');
					
				   f1.add(Validate.Presence,{failureMessage: " Please confirm password"});
				   f1.add( Validate.Length, { minimum: 5, maximum: 8 } );				   
				 </script>
                                    </div>
                                </div>
                               
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" form="student" class="btn btn-primary" onClick="return personal();">Submit</button>
                        </div>
                         </form>
		
        </table>
    	</div>
        
</body>
</html>