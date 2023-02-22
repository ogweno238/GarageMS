<?php
//require_once("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="10"></meta> -->
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo isset($title) ? $title . ' | Park Side Villa' :  'Park Side Villa' ; ?></title>

<style type="text/css">
.navbar-inverse {
    background-color:#0C9;
    border-color: #080808;
}
</style>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
</head>

    <link href="css/offcanvas.css" rel="stylesheet">


<body>
<!--Header-->

	    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	            <li><a href="home.php" >Home</a></li>
	            <li><a href="home.php">Reports</a></li>
	            <?php //if($_SESSION['ADMIN_UROLE']=="Administrator"){ ?>
	             <li><a href="home.php" >Users</a></li>
	             <?php //} ?>
	            <li><a href="logout.php">Logout</a></li>
	          </ul>
	   
	        </div><!-- /.nav-collapse -->
	      </div><!-- /.container -->
	    </div><!-- /.navbar -->
<!--
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="well">-->
				<!-- <img  width="1100px" hieght="100px" class="img-rounded"/> -->
		<!--	<div class="media">
			  <a class="pull-left" href="#">
			    <img class="media-object" src="../img/banner.png" alt="...">
			  </a>
			</div>
				</div>
			</div>
		</div>

-->
</div>     
 <?php include('search_form.php'); ?> 

<!--End of Header-->

<div class="container">

<?php //check_message(); ?>

	<!--/row-->
	
	<hr>
	     
        <script>


		  function checkall(selector)
		  {
		    if(document.getElementById('chkall').checked==true)
		    {
		      var chkelement=document.getElementsByName(selector);
		      for(var i=0;i<chkelement.length;i++)
		      {
		        chkelement.item(i).checked=true;
		      }
		    }
		    else
		    {
		      var chkelement=document.getElementsByName(selector);
		      for(var i=0;i<chkelement.length;i++)
		      {
		        chkelement.item(i).checked=false;
		      }
		    }
		  }

		  function checkNumber(textBox)
			{
				while (textBox.value.length > 0 && isNaN(textBox.value)) {
					textBox.value = textBox.value.substring(0, textBox.value.length - 1)
				}
				textBox.value = trim(textBox.value);
			}
			//
			function checkText(textBox)
			{
				var alphaExp = /^[a-zA-Z]+$/;
				while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
					textBox.value = textBox.value.substring(0, textBox.value.length - 1)
				}
				textBox.value = trim(textBox.value);
			}
		  </script>			
      </footer>
</div>
<!--/.container-->
</body>
</html>
 <script type="text/javascript">
	$('.start').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.end').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>