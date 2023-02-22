<?php include'auth.php';
      include'header_logs.php';
?><!DOCTYPE html>
<html>
<head>
		<title><?php echo isset($title) ? $title . ' | Crime Information System' :  'Crime Information System' ; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
    <link rel="icon" type="image/png" href="img/logo.png" />
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
    <br><br><br><br>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	
                <a href="#addModal" class="btn btn-info" data-toggle="modal">Add New Notification</a>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<div class="matter">
                
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                
<?php
include('../includes/dbcon.php');

    $query=mysqli_query($con,"select * from notefication order by noteid")or die(mysqli_error($con));
      while ($row=mysqli_fetch_array($query)){
        $id=$row['noteid'];
        $name=$row['notification'];
		$name=$row['date'];
       
?>  
<!-- Modal -->
<div id="delete<?php echo $id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete Add New Notification</h4>
            </div>
            <div class="modal-body" style="height:140px">
              <!--start form-->
              <form class="form-horizontal" method="post">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">
                  <div class="alert alert-danger">
                      Are you sure you want to delete <?php echo $name;?>?
                    </div>                     
                  <!-- Buttons -->
                  
                      
                        <button type="submit" class="btn btn-sm btn-primary" name="del">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                      
                 
              </form>
              <!--end form-->
            </div>
           
        </div><!--modal content-->
    </div><!--modal dialog-->
</div>
<!--end modal-->   
<!-- Modal -->
<!--end modal-->     
              <div class="col-md-4">
              <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left"><?php echo $name;?> - BY <?php //echo $date;?></div>
                  <div class="widget-icons pull-right">
                 
                    <a href="#delete" data-target="#delete<?php echo $id;?>" data-toggle="modal"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content referrer">
                  <!-- Widget content -->
                  
                  <table class="table table-striped table-bordered table-hover">
                    <tbody>
<?php

    $query1=mysqli_query($con,"select * from notefication where noteid='$id'")or die(mysqli_error($con));
      while ($row1=mysqli_fetch_array($query1)){
        $name=$row1['notification'];
        $date=$row1['date'];
        
?>                        
                    <tr>
                      <td><?php echo $name;?></td>
                    </tr> 
                   
                
<?php }?>                    
                    
                  </tbody></table>

                  <div class="widget-foot">
                  </div>
                </div>
              </div>

            </div>
              <!--end widget-->
            <?php }?>  
            </div>
          </div>
        </div>
      </div>
      <div id="dynamicInput">
    <!-- Matter ends -->


    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->


<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- Modal -->
<div id="addModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Add New Crime Alert</h4>
            </div>
            <div class="modal-body">
              <!--start form-->
              <form class="form-horizontal" method="post" action="alert_save.php">
                  <!-- Title -->
                  <div class="form-group">
                      <label class="control-label col-lg-3" for="title">Massage</label>
                      <div class="col-lg-8"> 
                        <input type="text" class="form-control" name="notification" id="title" placeholder="Alert Massage">
                      </div>
                  </div>                                   
                  <!-- Buttons -->
                  <div class="form-group">
                      <!-- Buttons -->
                      <div class="col-lg-offset-3 col-lg-6">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                       </div>
                  </div>
              </form>
              <!--end form-->
            </div>
            
        </div><!--modal content-->
    </div><!--modal dialog-->
</div>
<!--end modal--> 
  
<?php
    if (isset($_POST['del']))
    {
    $id=$_POST['id'];

  // sending query
  mysqli_query($con,"delete from notefication WHERE noteid='$id'")
  or die(mysqli_error());
  echo "<script>document.location='addnotification.php'</script>";
    }
    ?> 
<!-- JS -->
<?php include('../includes/js.php');?>  
<script>
         $(function () {
         //Initialize Select2 Elements
         $(".select2").select2();
         

     })
    </script>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

