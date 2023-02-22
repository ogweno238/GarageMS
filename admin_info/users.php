<?php include('header_suspect.php'); ?>
<?php require_once 'auth.php';?>
<?php include('navbar_suspect.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
                                    
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Users</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li><a href="dashboard.php">Home</a></li>
                                        
                                        <li style="float:right"><a href="logout.php">Logout</a></li>
									</ul>
						<!--  -->
						
							
                                 <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
								<p>&nbsp;</p>
                                <p>&nbsp;</p>
							
                            <thead>
                                    <tr>
									   <th  align="left"  width="20">Nationality</th>
				  		<th align="left"  width="100">
				  		Name</th>
				  		<!-- <th>Room#</th> -->
				  		<th align="left"  width="200">Contact</th>	
				  		<th align="left" width="120">Residence</th> 
				  		<th align="left"  width="20">Email</th>
                        <th  align="left"  width="20">Status</th>
                        <th  align="left"  width="20"> Action</th>
												
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php 

							
							
									

								  $user_query=mysql_query("SELECT *FROM profile tg,login gl WHERE tg.email = gl.email and status!='banned'")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['email'];  
									
									?>
									<tr class="del<?php echo $id ?>">
                                    <td><?php echo $row['national_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
									<td><?php echo $row ['contact']; ?> </td> 
                                    <td><?php echo $row['residence']; ?> </td>  
                                      <td width=""><?php echo $row['email']; ?></td> 
                                      <td width="100"><?php echo $row['status']; ?></td>
                                      <td width="150">
                                      <a href="burned.php?email=<?php echo $row['email']; ?>" 
                                      class="btn1 btn3-status" style="text-decoration:none;">Delete</a></td>
                                    </tr>
					
                               
									
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