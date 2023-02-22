
<?php 

include('connection.php');


// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file

        $studid = $_POST['studid'];
        $name = $_POST['name'];
        $platform = $_POST['platform'];
        $position = $_POST['position'];
        $course = $_POST['course'];
        $year = $_POST['year'];

    $filename = $_FILES['myfile']['name'];

    // $Admin = $_FILES['admin']['name'];
    // destination of the file on the server
    $destination = 'pictures/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];


    if (!array('jpg', 'jpeg', 'png', 'gif')) {
                echo '<script type = "text/javascript">
                            alert("You file extension must be:  .pdf");
                            window.location = "index.php";
                    </script>
                     ';
    } elseif ($_FILES['myfile']['size'] > 200000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else{


  $query=mysqli_query($conn,"SELECT studid FROM candidate where studid='$studid'")or die(mysqli_error($conn));
           $counter=mysqli_num_rows($query);
            
            if ($counter == 1) 
              { 
                   echo '
                <script type = "text/javascript">
                    alert("Candidate already added!");
                    window.location = "index.php";
                </script>


               ';
              } 
      
        date_default_timezone_set("asia/manila");
         $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));

        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO candidate(studid,name,platform,position,course,year,picture) 
					VALUES('$studid','$name','$platform','$position','$course','$year','$filename')";
            if (mysqli_query($conn, $sql)) {
                   echo '
                     <script type = "text/javascript">
                    alert("Successfully added new Candidate!");
                    window.location = "index.php";
                </script>';

            }
        } else {
             echo "Failed Upload files!";
        }
    
  }
}
