

						                            
                            <?php
               require_once 'core.php';
             include'db_connect.php';
            include('header_emails.php'); 


			$fir_refsql = "select * from fir_details WHERE fir_ref=fir_ref";
             $fir_refquery = $connect->query($fir_refsql);
            $countfir_ref = $fir_refquery->num_rows;
			
			$victimssql = "select * from victims_details WHERE status!='waiting'";
             $victimsquery = $connect->query($victimssql);
            $countvictims = $victimsquery->num_rows;
			
			$suspectsql = "select * from suspect_details WHERE status!='active'";
             $suspectquery = $connect->query($suspectsql);
            $countsuspect = $suspectquery->num_rows;
			
			
			
			$wantedsql = "select * from wanted_details  WHERE status!='waiting'";
             $wantedquery = $connect->query($wantedsql);
            $countwanted = $wantedquery->num_rows;

                     
           $fraudemployeesSql = "select * from fir_details WHERE status!='confirmed'";
      $fraudemployeesQuery = $connect->query($fraudemployeesSql);
         $countfraudemployees = $fraudemployeesQuery->num_rows;

            $connect->close();

?> <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info" style="background-color:#D04A4A; height:45px;">
               
                                    <strong style="color:#FFF;"><i class="icon-user icon-large"></i>&nbsp;
                                    <?php  $user_query=mysql_query("select * from admin where username = '" . $_SESSION['username'] .  "' ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['user_id'];  ?>
    Administrator Panel: <font color="#99FF33">Hi' <?php echo $row['username'];?><?php }?></font></strong>
                                </div>
								    <ul class="nav nav-pills">
										<li class="active"><a href="home.php">Home</a></li>
                                        <li><a href="graph_modal.php">Update Graph</a></li>
                                        <li><a href="graph.php">View Graph</a></li>
                                        <li><a href="logout.php">Logout</a></li>
									</ul>&nbsp;
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/custom.css" rel="stylesheet">
<div class="panel-group" id="accordion">
<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	#blinkeffect {
    -webkit-animation-name: blink;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;

    -moz-animation-name: blink;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;

    animation-name: blink;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blink {  
    0% { opacity: 1.0; color: red; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; color: yellow; }
}

@-webkit-keyframes blink {  
    0% { opacity: 1.0; color: red;}
    50% { opacity: 0.0; }
    100% { opacity: 1.0; color: yelllow; }
}

@keyframes blink {  
    0% { opacity: 1.0; color: red; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; color: yellow; }
}

</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
<div class="row">
	
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="fraud_detected.php" style="text-decoration:none;color:#03F;">
					Registered FIR
					<span class="badge pull pull-right" style="background-color:#03F;" id="blinkeffect"><?php echo $countfraudemployees; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="fraud_email_detected.php" style="text-decoration:none;color:#C09;">
					Crime suspects
					<span class="badge pull pull-right" style="background-color:#C09;"><?php echo $countsuspect; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="receiver_emails.php" style="text-decoration:none;color:#F00;">
					wanted criminals
					<span class="badge pull pull-right" style="background-color:#F00;"><?php echo $countwanted; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> 
    <div class="col-md-4" style="margin-top:10px; float:left">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="fraud_email_detected.php" style="text-decoration:none;color:#C09;">
					Crime Victims
					<span class="badge pull pull-right" style="background-color:#C09;"><?php echo $countvictims; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div><!--/col-md-4-->
&nbsp;

	<div class="col-md-4" style="margin-top:20px; float:right">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php 
		    	echo $countfir_ref; ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-envelope" style="color:#F00"></i> Total Registered FIR</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8" style="margin-top:20px; float:right">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		
	</div>

	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

							
			
			</div>		
			</div>
		</div>
    </div>