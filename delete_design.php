<?php
error_reporting(0);
include 'conn1.php';  // DB connection

// Get record ID from query string
$ans = $_GET['id1'] ?? null;

$qry = "DELETE FROM form WHERE id ='$ans' ";

$data = mysqli_query($conn,$qry);
    if ($data) { 
                echo "<script>alert('Record Deleted!')</script>";

 ?>
<meta http-equiv = "refresh" content = "0; url = http://localhost/stud/display.php" /> 
<?php
   } else {
               echo "Failed to Deleted!";

     }

?>