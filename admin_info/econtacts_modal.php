
<!-- modal -->
<div class="modal fade" id="myRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto; height:60%">
                <div class="modal-dialog" role="document"  style="width:90%; margin-left:10%;">
                    <div class="modal-content" style="width:90%;margin-left:10%;">
                        <div >
                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span><font color="#FF0000">Close </font>
                            </button></div>
                            <div class="pull-left" style="width:9%; float:left">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
                            <div class="container">
		<div class="margin-top">
					
 
		<form method="post" action="requesting_save.php">
<div class="span3">

               <?php  $user_query=mysql_query("select * from profile")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['profile_id'];  ?><?php }?>
											<div class="control-group">
				<label class="control-label" for="inputEmail">Name</label>
				<div class="controls">
             
				<?php $result =  mysql_query("select * from profile")or die(mysql_error()); 
				while ($row=mysql_fetch_array($result))
				      { ?>
               <select class="custom-select" name="profile_id"  style="width:200px;">
                    <option value = "1">...Select Client..</option>
                    
                    <option value ="<?php echo $row['profile_id']; ?>"> <?php echo $row['name']; ?></option>
                    </select>
				<?php } ?>
				</div>
			</div>
				<div class="control-group"> 
					<label class="control-label" for="inputEmail">Due Request</label>
					<div class="controls">
					<input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required />
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
				$query = "UPDATE profile SET checkout = 1";
				
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
	
					     $query = "SELECT * FROM profile";
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
							
                               <br /> <button type="submit" name = "submit" class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Request Now</button>
					</div>
				</div>
				</div>&nbsp;<br />
				<div class="span8" style="position:fixed;float:right; margin-left:5%;margin-top:-2%">
						
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example"  style="position:fixed;float:right; width:300px; margin-left:15%;top:45px">

                                <thead>
                                    <tr>
                       
                                                                        
                                       
										<th>Garage Service</th>
										<th>Description</th>
                                        
                                        <th>Price.</th> 
										<th>Select</th>
										
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query=mysql_query("select * from location ta,guarage tr where status != '100' and ta.location_id=tr.location_id ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['guarage_id'];  
									?>
									<tr class="del<?php echo $id ?>">
									
									                              
                                    
                                    
									
                                    <td><?php echo $row['guarage']; ?> </td> 
									 <td><?php echo $row['guarage_desc']; ?></td>
                         
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
    </div></div></div></div></div></div></div>
    
    <div class="modal fade" id="myFeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document"  style="width:90%; margin-left:5%; float:left">
                    <div class="modal-content" style="width:90%;margin-left:5%; float:left">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="pull-left" style="width:9%; float:left">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
                            
    
    <div style="width:90%;"><strong>Garage Feedback</strong></div>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example" style="width:40%;">

                                <thead>
                                    <tr>
                                        <th>Gurage</th>                                 
                                        <th>My Name</th>                                 
                                        <th>Date Requested</th>                                 
                                        <th>Due Request</th>
                                        <th>Price</th>                                
                                        <th>Date and Time</th>
										<th>Feedback Status</th>
                                    </tr>
                                </thead>
                                <tbody>
     
                               <?php  $user_query=mysql_query("select * from tbl_service
								LEFT JOIN profile ON tbl_service.profile_id = profile.profile_id
								LEFT JOIN servicedetails ON tbl_service.service_id = servicedetails.service_id
								LEFT JOIN guarage on servicedetails.guarage_id =  guarage.guarage_id WHERE service_status!='Cleared' and profile.email ='" . $_SESSION['email']."'
								   ");
									while($row=mysql_fetch_array($user_query)){
									$id=$row['service_id'];
									$guarage_id=$row['guarage_id'];
									$servicedetails_id=$row['servicedetails_id'];
				
									?>
                                    	<tr class="del<?php echo $id ?>">
									
									                              
                                    <td><?php echo $row['guarage']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
									<td><?php echo $row['date_requested']; ?></td> 
                                    <td><?php echo $row['due_date']; ?> </td>
									<td><?php echo $row['price']; ?> </td>
                                    <td><?php echo $row['date_return']; ?> </td>
									<td><?php echo $row['service_status'];?></td>
									
                                    <td></td> 
									 
                                    </tr>
									<?php  }  ?>
                                </tbody>
                            </table>

                    <!-- Controls -->
                    
                </div>
            </div> 
        </div>
				
				
			</div>		
			</div>
		</div>
    </div>
