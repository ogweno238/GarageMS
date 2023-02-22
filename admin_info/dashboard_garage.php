

						                            
                            <?php
               require_once 'core.php';
             include'db_connect.php';
            include('header_info.php'); 

          
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

?> <div class="container">
			<div class="row">	
			
			   
               
								    <ul class="nav nav-pills alert alert-info" style="background-color:#F00;">
										<li class="active"><a href="dashboard.php">Home</a></li>
                                        <li><a href="Users.php">USERS</a></li>
                                        
                                        <li style="float:right"><a href="logout.php">Logout</a></li>
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
				
				<a href="requested_garage_service.php" style="text-decoration:none;color:#03F;">
					Requested Services
					<span class="badge pull pull-right" style="background-color:#03F;" id="blinkeffect"><?php echo $countRequested; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="garage.php" style="text-decoration:none;color:#C09;">
					Add Garage Services
					<span class="badge pull pull-right" style="background-color:#C09;"><?php echo $countguarage; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="confirmed_garage_service.php" style="text-decoration:none;color:#F00;">
					Confirmed Services
					<span class="badge pull pull-right" style="background-color:#F00;"><?php echo $countConfirmed; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> 
    
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
		    	echo $countService; ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-book" style="color:#F00"></i> Services Registered</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8" style="margin-top:20px; float:right">
		<div class="panel panel-default">
			<div class="panel-heading"> <div id="bloglist" class="row">

     <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left"> 
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Car Fail Start</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
            <div class="media-body">
                   <center>   <img src="images/car1.jpg" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>

      <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left">  
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Broken Window</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
            <div class="media-body">
                   <center>   <img src="images/busted-out-window.jpg" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>
       <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left"> 
            </div>
            <div class="pull-right text-left">
             <a href="#" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Unkown Breakdown</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
           
            <div class="media-body">
                <center>   <img src="images/Person sitting near their broken down car.jpg" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>

     <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left"> 
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Key Locked Inside</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
            <div class="media-body" style="background:url(images/Person%20sitting%20near%20their%20broken%20down%20car.jpg)">
              
               <center>   <img src="images/key locked in car.jpg" id="picture"></center><style type="text/css">
			  #picture {
    height: 120px;
    width: 170px;
	 border-radius: 6px;
}
.img-rounded {
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
}
.img-rounded {
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
}

img {
    vertical-align: middle;}  </style>
  <script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script></center> </div>
            </div>
        </div>
    </div>

      </div>
    </div>

     <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left">         
             
            </div>
            <div class="pull-right text-left"><a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Dump-Fuel</a>
           
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
           
            <div class="media-body">
                  <center>   <img src="images/dieselpump.jpg" id="picture"></center> </div>
            </div>
            </div>
        </div>
   
      <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left">  
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Car-Crash</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
            <div class="media-body">
                    <center>   <img src="images/car-crash-claims-featured.png" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>

       <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left">
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Engine-Breakdown</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
           
            <div class="media-body">
                   <center>   <img src="images/timthumb.jpg" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>

     <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="people-item service-card">
        <div class="panel-heading"> 
            <div class="pull-left">
            </div>
            <div class="pull-right text-left">
            <a href="" data-toggle="modal" data-target="#myRequest" class="btn btn-sm btn-default">Puncher</a>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="media">
            <div class="media-body">
                  <center>   <img src="images/puncher.jpg" id="picture"></center>
                
            </div>
            </div>
        </div>
    </div>

      </div>
			<div class="panel-body">
				
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
    </div><?php include_once'case.php'?>
	
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
     <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>