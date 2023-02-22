<?php include('header_suspect.php'); ?>
<?php require_once 'auth.php';?>
<?php include('navbar_suspect.php'); ?>

    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
                                    
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Garage</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li><a href="dashboard.php">Home</a></li>
                                        
										<li style="float:right"><a href="logout.php">Logout</a></li>
									</ul>
						<!--  -->
						<center class="title">
						<h1>Books List</h1>
						</center> </div> <a style="float:right" rel="tooltip"  title="Add House" href="#add_house" data-toggle="modal"    class="btn btn-success"><i class="icon-check icon-large"></i>Add</a>
                                    <?php include('modal_garage.php'); ?></strong>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example" style="margin-tight:-15%">
								<div class="pull-right">
								
								</div>
								<p>&nbsp;</p>
                                <p>&nbsp;</p>
							
                                <thead>
                                    <tr>
                                        <th>Car Service</th>                                 
                                        <th>Description</th>
										<th>Price</th>
										<th>Location</th>
                                        <th>Action</th>
										
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query=mysql_query("select * from guarage
								  LEFT JOIN location ON guarage.location_id = location.location_id
								ORDER BY guarage_id DESC
								  ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['guarage_id'];
									$guarage_id=$row['guarage_id'];
									?>
									<tr class="del<?php echo $id ?>">                     
                                    
                                    <td><?php echo $row['guarage']; ?></td>
                                    <td><?php echo $row['guarage_desc']; ?></td>
									<td><?php echo $row['price']; ?></td> 
                                    <td><?php echo $row['location']; ?> </td>
									<td>
                                    <a rel="tooltip"  title="Delete house" id="<?php echo $guarage_id; ?>" href="#delete_house<?php echo $guarage_id; ?>" data-toggle="modal" class="btn btn-danger"><i class="icon-check icon-large"></i>Delete</a>
                                    <?php include('modal_delete.php'); ?>
                                    
									 
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