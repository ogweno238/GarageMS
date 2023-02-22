<?php 
$conn = mysqli_connect("localhost","root","","electro_college");

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}
?>