<?php
// configuration
include('dbconnect.php');

// new data
$user_id = $_POST['memids'];
$mm = $_POST['username'];
$ss = $_POST['password'];
$a = $_POST['power'];
// query
$sql = "UPDATE admin 
        SET username=?, password=?, power=?
		WHERE user_id=?";
$q = $db->prepare($sql);
$q->execute(array($mm,$ss,$a,$user_id));
header("location: adminaccount.php");

?>