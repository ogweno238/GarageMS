<?php

require('dbconn.php');
require('functions.php');
@session_start();
$sql = mysql_query("update candidate set votecount = '0'");
$sql1 = mysql_query("DELETE FROM  votecount");
if($sql and $sql1)
{
$admin="<meta http-equiv=\"Refresh\" content=\"0;url=results.php\">";
echo($admin); 
} else {
echo "voting re-started";
}
?>