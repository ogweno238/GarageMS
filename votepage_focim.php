<?php
include('header.php');
include ('session.php');
$user_query = mysql_query("select * from students where studid='". $_SESSION['Admin_Logon']."'") or die(mysql_error());
$user_row = mysql_fetch_array($user_query);
?>
<?php 
require('conn.php');
require('functions.php');
@session_start();

if($_SESSION['Admin_Logon'] = isset($member['studid'])){
		$admin="<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">";
		echo($admin);  
}else{

$vote = mysql_query("SELECT * FROM position Where position ='".$_GET['cat']."' order by IDNo");
$rj=mysql_fetch_array($vote);

//			echo $_SESSION[$rj['position']];
		if (isset($_SESSION[$rj['position']]) == 1)
		{
		$category = "";
		$admin="<meta http-equiv=\"Refresh\" content=\"0;url=./category_focim.php\">";
		echo($admin); 
		} else {
		$category = $_GET['cat'];
		$button = "<input name=\"vote\" type=\"submit\" id=\"vote\" value=\"VOTE\" class='btn btn-danger'>";
		} 

	/*}else {
$admin="<meta http-equiv=\"Refresh\" content=\"0;url=./index.php\">";
echo($admin); 
}*/
	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/candidate.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {color: #990000}
.style3 {	font-size: 24pt;
	color: #FFCC66;
	font-weight: bold;
}
.style3 {	color: #FFCC66;
	font-size: 16pt;
}
.style7 {color: #FFCC66; font-size: 25pt; font-weight: bold; }
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>

<script type="text/javascript">
<!--
//initial checkCount of zero
var checkCount=0

//maximum number of allowed checked boxes
var maxChecks=<?php echo $rj['Limit']?>

function setChecks(obj){
//increment/decrement checkCount
if(obj.checked){
checkCount=checkCount+1
}else{
checkCount=checkCount-1
}
//if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
if (checkCount>maxChecks){
obj.checked=false
checkCount=checkCount-1
alert('you may only choose up to '+maxChecks+' options')
}
}
//-->
</script>
</head>

<body>
<?php include('navhead_students.php'); ?>

    <div class="container">
        <div class="row-fluid">
            <div class="span3">
                <div class="hero-unit-3">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div> 
                
                <div class="hero-unit-1">
                    <ul class="nav  nav-pills nav-stacked">
                       
                        <li>
                            <a href="category_focim.php"><i class="icon-home icon-large" style="color:#F00"></i>&nbsp;BACK
                                  
                            </a>

                        </li>
                </div>

            </div>
            
            <div class="span9">
             <div class="hero-unit-3">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;ELECTROL COLLAGE DOCKET</strong>
                        </div>
<p><?php 
//echo $category;
$q2 = mysql_query("SELECT
candidate.id,
candidate.`position`,
candidate.name,
candidate.platform,
candidate.picture,
candidate.votecount,
candidate.sy
FROM
candidate ,
`position`
WHERE
candidate.`position` =  `position`.`position` 
and candidate.`position` = '$category'
ORDER BY
`position`.`IDNo` ASC");
$p = mysql_num_rows($q2);
$a = $category;

  
?>
</p>
<table width="423" border="0" align="center">
  <tr>
    <th height="61" colspan="4" align="left" nowrap scope="col"><span class="style2"><?php echo $category ?></span></th>
  </tr>
  <?php 
  while($r2=mysql_fetch_array($q2))
	{
	
  ?>
  <form name="vote" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <tr>
      <th width="39" align="left" nowrap scope="row">&nbsp;</th>
      <th width="101" align="left" nowrap scope="row"><img src="admin/pictures/<?php echo $r2['picture'] ?>" width="101" height="84"></th>
      <th width="263" align="left" valign="top" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r2['platform'] ?></th>
      <th width="2" align="left" nowrap>&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" align="left" nowrap scope="row" style="border-bottom-style:groove" ><blockquote>
        <?php 
	  if($rj['Limit']==1)
	  {
	  ?>
        <input name="candidate[]" type="radio" value="<?php echo $r2['name'] ?>">
        <?php echo $r2['name'] ?>
        <input name="total[]" type="hidden" value="<?php echo $r2['votecount'] ?>">
      </blockquote></th>
    </tr>
    <?php 
	  } else {
	   ?>
    <input class="uniform_on" type="checkbox" required name="candidate[]" value="<?php echo $r2['name'] ?>" onClick="setChecks(this)">
    <?php echo $r2['name']; ?>
    <input name="total[]" type="hidden" value="<?php echo $r2['votecount'] ?>">
    <tr>
      <td><th width="101" align="left" nowrap>&nbsp;</th>
      <td height="10"><?php
	} 
	}
	  ?>
          <?php 
//echo   $_SESSION["Admin_UserLogon"];
  echo $r2['name'] ?>
          
    <tr>
        <th nowrap scope="row"> <input name="cat" type="hidden" value="<?php echo $category ?>">
          <?php echo $button ?>  <input class='btn btn-success' name="close" type="submit" onClick="MM_goToURL('parent','category_focim.php');return document.MM_returnValue" value="BACK">
		  
  </form>

  <th colspan="2" nowrap>&nbsp;</th>
  </tr>
  <?php 
 		//$t = $_POST['total'] + 1;
		
		if(isset($_POST['vote']))
		{
		
		$can = $_POST['candidate'];
		
		
			//if($_GET['cat'] == "Councilors")
			//{
			
				foreach ($can as $one_can) 
				{  
				$source .= $one_can."";  
				$candidate = substr($source, 0, -2);
			
				$vote1 = mysql_query("update candidate set votecount = votecount + 1 where position = '$_POST[cat]' and name = '".$one_can."'");
				echo $_SESSION["Admin_UserLogon"];
				}
				 if(!$vote1)
					{
					echo "Cadidate Not Selected";
					} else {
					$sqlin = mysql_query("INSERT INTO votecount set Result = '1', studid = '".$_SESSION["Admin_UserLogon"]."', Position='".$_POST['cat']."'");
					$admin="<meta http-equiv=\"Refresh\" content=\"0;url=./category_focim.php\">";
					echo($admin); 
				}	
	
	}
	?>
</table>
<script type="text/javascript">		
$(".uniform_on").change(function(){
    var max=1;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('Voting 1 Candidate is allowed per Docket');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
})
</script>
</body>
</html>
<?php
}
?>