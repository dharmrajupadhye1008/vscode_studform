<?php
$server = "localhost:3307";
$user = "root";
$password = "";
$db = "responsiveform";

$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//   else {
//     echo "Database connected successfully!";
// }
?>
