<?php
	include('dbconn.php');
	$email=$_GET['email'];
	$result = $db->prepare("UPDATE login SET status='banned' WHERE email= :memid");
	$result->bindParam(':memid', $email);
	$result->execute();
	?>
    <script>alert('deleted!');
            window.location.href = "users.php";</script>

    <?php
?>