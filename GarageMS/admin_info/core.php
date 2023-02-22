<?php 

session_start();

require_once 'db_connect.php';
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: index.php");
		exit();
	}


?>