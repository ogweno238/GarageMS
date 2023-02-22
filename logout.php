
<?php
session_start();
session_destroy();
$link = mysql_connect('localhost','root',"");
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db("online_guarage", $link);
	if(!$db) {
		die("Unable to select database");
	}
header("location:index.php");

?>

