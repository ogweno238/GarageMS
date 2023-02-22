<?php 
include('dbcon.php');
if (isset($_POST['submit'])){
$guarage=$_POST['guarage'];
$location_id=$_POST['location_id'];
$guarage_desc=$_POST['guarage_desc'];
$price=$_POST['price'];




								
mysql_query("insert into guarage(guarage,location_id,guarage_desc,price,status)
 values('$guarage','$location_id','$guarage_desc','$guarage_desc','vacant')")or die(mysql_error());
 
 
header('location:garage.php');
}
?>	