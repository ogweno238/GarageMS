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
						<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
								<p>&nbsp;</p>
                                <p>&nbsp;</p>
							
                                <thead>
                                    <tr>
                                        
                                        <th>Drivers' Name</th> 
                                         <th>Service Offered</th> 
                                        <th>Contact</th>                                                              
                                        <th> Amount Paid</th>  
                                        <th> Status</th>                                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  $user_query=mysql_query("select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id WHERE email='".$_SESSION['Admin_UserLogon']."'
								ORDER BY tbl_service.service_id")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['service_id'];
									$servicedetails_id=$row['servicedetails_id'];
									$email=$row['email'];
									$guarage_id=$row['guarage_id'];
				
									?>
									<tr class="del<?php echo $id ?>">
                                    <td width="130"><?php echo $row['name']; ?></td>
                                    <td width="70"><?php echo $row['guarage']; ?></td>	
                                    <td width="130"><?php echo $row['contact']; ?></td>
                                    <td width="70"><?php echo $row['price']; ?></td> 
                                    <td width="70"><?php echo $row['service_status']; ?></td>
                                    
                                    </tr>
									<?php  }  ?>
                           
                               </tbody>
						
       
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