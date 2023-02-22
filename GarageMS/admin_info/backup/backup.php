<?php session_start();
 if(isset($_POST['host']) and isset($_POST['username'])  and $_POST['host']!="" and $_POST['username']!="")
        {
         $host=  trim($_POST['host']);
            $user= trim($_POST['username']);
            $pass= trim($_POST['password']); 
            $name;
            if(isset($_POST['name'])){
                $name=$_POST['name'];
            }
            if(isset($_POST['select_box'])){
                $name=$_POST['select_box'];
            }
            $_SESSION['host']=$host;
            $_SESSION['user']=$user;
            $_SESSION['pass']=$pass;
            $_SESSION['db_name']=$name;
                    $link = mysql_connect("$host","$user","$pass");
if (!$link) {
    $data="Database Configration is Not vaild";
      header("location:instal.php?msg=$data");
      exit;
}

$con=mysqli_connect("$host","$user","$pass");
// Check connection
 if(isset($_POST['name'])){
$sql="CREATE DATABASE $name";
if (!mysqli_query($con,$sql)){
    $data="This Database Name Is Already In the DataBase";
      header("location:database_instal.php?msg=$data");
      exit;
}
 }
        
        $con=mysqli_connect("$host","$user","$pass","$name");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $dummy=0;
if(isset($_POST['dummy'])){
    $dummy=1;
}
// Create table
$sql="CREATE TABLE IF NOT EXISTS `tblcases` (
  `case_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date() NOT NULL,
  `plaintiff` varchar(200) NOT NULL,
  `defendant` varchar(200) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `contact` varchar(120) NOT NULL,
  `representation` varchar(200) NOT NULL,
  `prayers` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` varchar(120) NOT NULL,
  `type` varchar(120) NOT NULL,		
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20";
mysqli_query($con,$sql);
          $sql="INSERT INTO `tblcases` (`date`, `plaintiff`, `defendant`, `email_id`, `contact`, `representation`, `prayers`, `remarks`, `status`, `type`) VALUES
(NOW(), 'kilifi Law Court', 'Mombasa Law Court', 'kilifi@gmail.com', '0719278138', 'Law Society', 'Justice for all', 'Peace prevail', 'pending', 'succession')";
 mysqli_query($con,$sql);
// Execute query
$sql="CREATE TABLE IF NOT EXISTS `case_type` (
  `casetype_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `case` varchar(120) NOT NULL,
  PRIMARY KEY (`casetype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";

mysqli_query($con,$sql);
$sql="INSERT INTO `admin_user` ( `case`) VALUES
( 'succession'); ";


// Execute query

$sql="CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `user_type` varchar(120) NOT NULL,
  `answer` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";

mysqli_query($con,$sql);
$sql="INSERT INTO `admin_user` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin'); ";

// Execute query
mysqli_query($con,$sql);
          //
          $sql="CREATE TABLE IF NOT EXISTS `kilifi_details` (
  `name` varchar(100) NOT NULL,
  `log` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

          // Execute query
          mysqli_query($con,$sql);
          $sql="INSERT INTO `kilifi_details` (`name`, `log`, `type`, `address`, `place`, `city`, `phone`, `email`, `web`, `pin`) VALUES
('Kilifi', 'kilifi.png', 'png', '133', 'HSR Layout', 'Mombasa', '779539126325', 'info@kilifi.com', 'www.kilifi.com', '407020')";

          // Execute query
          mysqli_query($con,$sql);
 $ourFileName = "config.php";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
$data = '<?php $config["database"] = "'.$name.'"; $config["host"]= "'.$host.'";$config["username"]= "'.$user.'"; $config["password"]= "'.$pass.'";?>';
fwrite($ourFileHandle, $data);
fclose($ourFileHandle);
 header("location:user_details.php");


?>



<?php



        }else{
          header("location:instal.php");
        }
 //

?> 