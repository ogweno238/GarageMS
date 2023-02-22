<?php
	require_once('auth.php');
?>
<html>
<head>
<title>
	Electoral Collage E-Voting System
</title>
<!-- CSS Style -->
<link rel="stylesheet" href="admin.css">
<link rel="icon" type="image/png" href="img/logo.png" />
<script src="dng_comedor.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<!--sa poip up-->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
</head>
<body>
	<div id="top">
		<div class="logo">
			<img src="images/logo.jpg"> <span style="float:right; color:#FFFFFF; font-weight:bold; display: inline-block; padding: 20px 0 0 20px;">Hello <?php echo $_SESSION['USERNAME'] ?></span>
		</div>
	</div>
	<div class="container  clearfix">
		<div class="one-third1 column">
			<ul>
            
			    <li><a href="index.php"><img alt="" src="img/home.png"><span>Students</span></a></li>
				<li><a href="students.php"><img alt="" src="img/page.png"><span>Candidates</span></a></li>
                <li><a rel="facebox" href="print_voters.php"><img alt="" src="img/menuorder.png"><span>Print Voters</span></a></li>
                <li><a href="results.php"><img alt="" src="img/votes.png"><span>Votes Server</span></a></li>
                
				<?php 
				$jhjh=$_SESSION['POWER'];
				if($jhjh==1){
				?>
               <li><a href="talling_report.php"><img alt="" src="img/team.png"><span>Download Result</span></a></li>	
				<li class="active"><a href="team.php"><img alt="" src="img/user.png"><span>Team</span></a></li>
                <li><a rel="facebox" href="resetvotes.php" onClick="return confirm('Are you sure?')"><img alt="" src="img/reset.png"><span>Reset Talling</span></a></li>
				<li><a href="adminaccount.php"><img alt="" src="img/userpic.jpg"><span>Maintenance</span></a></li>
				<?php
				}
				?>
				<li><a href="logout.php"><img alt="" src="img/logout.png"><span>Logout</span></a></li>
			</ul>
		</div>
		<div class="two-thirds1 column">
			<div class="thewraper">
			<div id="formdesign"><input type="text" name="filter" value="" id="filter" placeholder="search..." autocomplete="off" /></div>
			<a rel="facebox" href="addteam.php"> Add Team </a>
			<table id="resultTable" data-responsive="table">
				<thead>
					<tr>
						<th> Team Name </th>
						<th> Team Leader </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
					
						<?php
							include('dbconnect.php');
							$result = $db->prepare("SELECT * FROM election_team");
							$result->execute();
							for($i=0; $row = $result->fetch(); $i++){
						?>
						<tr class="record">
						<td><?php echo $row['eln_name']; ?></td>
						<td><?php echo $row['eln_leader']; ?></td>
						<td><a rel="facebox" href="editteam.php?ieckid=<?php echo $row['ieckid']; ?>"> Edit </a> |
                         <a href="#" id="<?php echo $row['ieckid']; ?>" class="delbutton" title="Click To Delete">Delete</a></td>
						</tr>
						<?php
							}
						?>
					
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="copyrights">&copy; Electoral Collage E-Voting System</div>
	</div>
		<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteteam.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
</html>