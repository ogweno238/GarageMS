<?php
include('header.php');
include ('session.php');

?>
<?php

require('conn.php');
require('functions.php');
@session_start();

if($_SESSION['Admin_Logon'] = isset($member['email'])){
		$admin="<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">";
		echo($admin); 
}else{

$stud = mysql_query("select * from login where email = '".$_SESSION["Admin_UserLogon"]."'");
$s = mysql_fetch_array($stud);


?>
<?php
               
             include'db_connect.php';

          
			$RequestedSql = "select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id WHERE service_status='pending'
								ORDER BY tbl_service.service_id";
$RequestedQuery = $connect->query($RequestedSql);
$countRequested = $RequestedQuery->num_rows;
			
			$guaragesql = "select * from guarage WHERE guarage_id=guarage_id";
             $guaragequery = $connect->query($guaragesql);
            $countguarage = $guaragequery->num_rows;

           $ConfirmedSql = "select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id WHERE service_status='Accepted'
								ORDER BY tbl_service.service_id";
$ConfirmedQuery = $connect->query($ConfirmedSql);
$countConfirmed = $ConfirmedQuery->num_rows;

$ServiceSql = "select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id 
								ORDER BY tbl_service.service_id";
$ServiceQuery = $connect->query($ServiceSql);
$countService = $ServiceQuery->num_rows;

            $connect->close();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/candidate.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #0000CC}
.style2 {
	font-size: 24pt;
	color: #FFCC66;
	font-weight: bold;
}
.style3 {
	color: #FFCC66;
	font-size: 16pt;
}
-->
</style>
</head>
<?php 
				$jhjh=$_SESSION['Admin_UserLevel'];
				if($jhjh==1){
				?>
				<?php
				}
				?>
<body>
<body>

    <?php include('navhead_students.php'); ?>

    <div class="container">
        <div class="row-fluid">
            <div class="span3">
                <div class="hero-unit-3">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                <div class="hero-unit-1">
                    <ul class="nav  nav-pills nav-stacked">
                        <li class="nav-header">Links</li>
                        <li>
                            <a href="garage_dashboard.php"><i class="icon-home icon-large" style="color:#F00"></i>&nbsp;GARAGE DASGBOARD
                                  
                            </a>

                        </li>
                        <li class="active">
      <a href="garage_services.php">Book Services</a><br>
	   <a href="garage_history.php">Services History</a><br>
	  </li>
	  
    </ul>
                </div>

            </div>
            <div class="span9">
            <div class="hero-unit-3">
			
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Check Garage Services </strong>
                        </div>
						
						
       
            <div class="control-group">
                <div class="controls">
				
                 <center>
				 <form method="post" action="requesting_save.php">
<div class="span3">

               
											<div class="control-group">
				
				<div class="controls">
             
				<?php $result =  mysql_query("select * from profile where email = '" . $_SESSION['Admin_UserLogon'] . "' ")or die(mysql_error()); 
				while ($row=mysql_fetch_array($result))
				      { ?>
               <input type="hidden" name="profile_id" class="chzn-select" value="<?php echo $row['profile_id']; ?>" placeholder="<?php echo $row['name']; ?>"> 
               <input type="hidden"  name="profile_id" placeholder="<?php echo $row['name']; ?>" disabled>
				<?php } ?>
				</div>
			</div>
				<div class="control-group"> 
					
					<div class="controls">
					<input type="date"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required />
					</div>
				</div>
                
				<div class="control-group"> 
					<div class="controls">
                       <?php
					   
					   if(isset($_POST['submit'])){
	        	if(empty($_POST['books']) || !isset($_POST['books'])){
			   die('Hostel required');
		      }
		
		    $guarag_id = $_POST['guarag'];
		
		   $query = "UPDATE guarage SET status = 1 WHERE id = $guarag_id";
		  $res = mysql_query($query);
		
		if($res){
			if(mysql_affected_rows() > 0){
				$query = "UPDATE profile SET checkout = 1 WHERE email = '" . $_SESSION['email'] . "'";
				
				$res = mysql_query($query);
				
				if(mysql_affected_rows()){
					echo $msg = '<script type="text/javascript">
								alert ("Service Succesfully Contacted");
							</script>' ;;
				}
			}
		}
		else{
			die(mysql_error());
		}
	}
	
					     $query = "SELECT * FROM profile WHERE email ='" . $_SESSION['email']."'";
	                 $res = mysql_query($query);
	                   if($res){
	                 	while($r = mysql_fetch_array($res)){
		              	$status = $r['checkout'];
	                  	}
	                     }
	                 else{
		            die(mysql_error());
	              }
                ?>
							
                               <br /> <button type="submit" name = "submit" <?php echo $status == 1 ? 'disabled' : '';?> class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Request Now</button>
					</div>
				</div>
				</div>&nbsp;<br />
				<div class="span8" style="position:fixed;float:right; margin-left:25%;margin-top:-2%">
						
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                <thead>
                                    <tr>
                       
                                                                        
                                       
										<th>Garage Service</th>
										<th>Description</th>
                                        <th>Location</th>
                                        <th>L-Description</th>
                                        <th>Price.</th> 
										<th>Select</th>
										
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php   include'db_connect.php';  $user_query=mysql_query("select * from location ta,guarage tr where status != '1' and ta.location_id=tr.location_id ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['guarage_id'];  
									?>
									<tr class="del<?php echo $id ?>">
									
									                              
                                    
                                    
									
                                    <td><?php echo $row['guarage']; ?> </td> 
									 <td><?php echo $row['guarage_desc']; ?></td>
                                      <td><?php echo $row['location']; ?></td>
                                      <td><?php echo $row['locationdesc']; ?></td>
                                      <td><?php echo $row['price']; ?></td> 
									
                                    <td width="20">
												<input id="uniform_on" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>" >
												
                                    </td>
									
                                    </tr>
									<?php  }  ?>
                                </tbody>
                            </table>
							
			    </form>
			</div>		
			</div>		
<script type="text/javascript">		
$(".uniform_on").change(function(){
    var max=1;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('only one garage at atime');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
})
</script>		
			</div>
		</div>
    </div>
    </div>
        </div>
<?php include('footer.php'); ?>
    </div>
</div>
</div>

  
</body>
</html>
<?php }?>