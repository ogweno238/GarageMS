

<?php 
include('dbcon.php');

$id=$_GET['id'];
$guarage_id = $_GET['guarage_id'];
mysql_query("update guarage  set status='0' where guarage_id = '$guarage_id'");
mysql_query("update tbl_service LEFT JOIN profile ON profile.profile_id = profile.profile_id
                                LEFT JOIN servicedetails on tbl_service.service_id = servicedetails.service_id  set service_status='cleared',checkout='0',date_return= NOW() where tbl_service.service_id='$id' and servicedetails.guarage_id = '$guarage_id'")or die(mysql_error());						
 header('location:dashboard.php');

?>	