<?php include('header_suspect.php'); ?>
<?php require_once 'auth.php';?>
<?php include('navbar_suspect.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			    <ul class="nav nav-pills alert alert-info" style="background-color:#F00;">
										<li><a href="dashboard.php">Home</a></li>
                                        
										<li style="float:right"><a href="logout.php">Logout</a></li>
                                        
									</ul>
						<!--  -->
						<center class="title">
						
						</center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
								<p>&nbsp;</p>
                                <p>&nbsp;</p>
							
                                <thead>
                                    <tr>
                                        
                                        <th>Drivers' Name</th> 
                                         <th>Garage Service</th> 
                                        <th>Contact</th>                                                              
                                        <th> Price</th>  
                                        <th> Status</th>                                 
                                        <th> Action</th>                                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  $user_query=mysql_query("select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id WHERE service_status!='pending'
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
                                    <td width="100"><a rel="tooltip" id="<?php echo $servicedetails_id; ?>" href="#delete_book<?php echo $servicedetails_id; ?>" data-toggle="modal"    class="btn btn-success">Clear service&nbsp;<i class="icon-check icon-large"></i></a>
                                    <?php include('modal_return.php'); ?></td>
                                    </tr>
									<?php  }  ?>
                           
                               </tbody>
  <style type="text/css">
	.btn1-status {
    color: #fff;
    background-color:#C39;
    border-color: #4cae4c;
}
.btn2-status {
    color: #fff;
    background-color:#9F3;
    border-color: #4cae4c;
}
.btn3-status {
    color: #fff;
    background-color:#F00;
    border-color: #4cae4c;
	}
.btn4-status {
    color: #fff;
    background-color:#49afcd;
    border-color: #4cae4c;
}
.btn5-status {
    color: #fff;
	background-color:#930;
    border-color: #4cae4c;
}
.btn1 {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 10px;
	font-family:"Times New Roman", Times, serif;
    font-weight:900;
    line-height: 1.428571429;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
	text-decoration:none;
}
a {
    text-decoration: none;
}

							</style>                          </table>
							
			
			</div>		
			</div>
		</div>
    </div>