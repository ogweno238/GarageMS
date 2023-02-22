<!DOCTYPE html>
<html>
<head>
		<title><?php echo isset($title) ? $title . ' | Revolutionary Garage management System' :  'Revolutionary Garage management System' ; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
            <link rel="icon" type="image/png" href="img/logo.png" />
			<link href="cs/bootstrap.css" rel="stylesheet" media="screen">
			<link href="cs/bootstrap-responsive.css" rel="stylesheet" media="screen">
			<link href="cs/docs.css" rel="stylesheet" media="screen">
			<link href="cs/diapo.css" rel="stylesheet" media="screen">
			<link href="cs/font-awesome.css" rel="stylesheet" media="screen">
			<link rel="stylesheet" type="text/css" href="cs/style.css" />
			<link rel="stylesheet" type="text/css" href="cs/DT_bootstrap.css" />
			<link rel="stylesheet" type="text/css" media="print" href="cs/print.css" />
	
	<!-- js -->			
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
     <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	 <script src="js/jquery.hoverdir.js"></script>
			
<script>
jQuery(document).ready(function() {
$(function(){
	$('.pix_diapo').diapo();
});
});
</script>	
	<noscript>
			<style>
				.da-thumbs li a div {
					top: 0px;
					left: -100%;
					-webkit-transition: all 0.3s ease;
					-moz-transition: all 0.3s ease-in-out;
					-o-transition: all 0.3s ease-in-out;
					-ms-transition: all 0.3s ease-in-out;
					transition: all 0.3s ease-in-out;
				}
				.da-thumbs li a:hover div{
					left: 0px;
				}
			</style>
		</noscript>		
		
	 <script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
	<script type='text/javascript' src='scripts/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='scripts/jquery.hoverIntent.minified.js'></script> 
<script type='text/javascript' src='scripts/diapo.js'></script> 


<!--sa calendar-->	
		<script type="text/javascript" src="js/datepicker.js"></script>
        <link href="cs/datepicker.css" rel="stylesheet" type="text/css" />

</head>
<?php include('dbcon.php'); ?>
<body>
<nav class="navbar navbar-default navbar-static-top">
		<h1 style="margin-left:30%;" class="h1"> <font style="font-family:'Times New Roman', Times, serif; color:#03F;">REVOLUTIONARY GARAGE ADMIN AREA</font></h1>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
    <style type="text/css">.navbar {
    font-size: 13px;
}
.navbar-default {
    background-color: #f8f8f8;
    border-color: #e7e7e7;
}
@media (min-width: 768px)
.navbar-static-top {
    border-radius: 0;
}
.navbar-static-top {
    border-width: 0 0 1px;
}
@media (min-width: 768px)
.navbar {
    border-radius: 4px;
}
.navbar {
    position: relative;
    z-index: 1000;
    min-height: 50px;
    margin-bottom: 20px;
    border: 1px solid transparent;
}
h1, .h1 {
    font-size: 36px;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 500;
    line-height: 1.1;
}
h1 {
    margin: 0.67em 0;
    font-size: 2em;
}
h1 {
    font-size: 38.5px;
}
h1, h2, h3 {
    line-height: 40px;
}
h1
    text-rendering: optimizelegibility;
}
</style>