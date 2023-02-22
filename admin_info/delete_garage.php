<?php 
include('dbcon.php');

$id=$_GET['id'];
$guarage_id = $_GET['guarage_id'];
mysql_query("DELETE guarage FROM guarage where guarage_id = '$guarage_id'");
						
 header('location:garage.php');

?>	