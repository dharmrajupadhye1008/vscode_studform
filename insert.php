<?php
include 'conn1.php';

if (isset($_POST['save'])) {
    error_reporting(0);


     // Create uploads folder if not exists
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Get file details
    $filename  = $_FILES["file"]["name"];
    $tempname  = $_FILES["file"]["tmp_name"];
    $filesize  = $_FILES["file"]["size"];
    $fileerror = $_FILES["file"]["error"];

    // Set destination path
    $folder = $uploadDir . basename($filename);

    // Allowed file types (example: images only)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if ($fileerror === 0) {
        if (in_array($fileExt, $allowedTypes)) {
            if ($filesize < 2 * 1024 * 1024) { // 2MB limit
                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "File uploaded successfully!";
                } else {
                    $msg = "Error uploading file.";
                }
            } else {
                $msg = "File is too large. Max 2MB allowed.";
            }
        } else {
            $msg = "Invalid file type. Only JPG, PNG, GIF allowed.";
        }
    } else {
        $msg = "Error uploading file.";
    }
 

    // 1. Getting form data
    $fname    = $_POST['fname'];
    $lname    = $_POST['lname'];
    $pass     = $_POST['pass'];
    $pass1    = $_POST['pass1'];
    $gender   = $_POST['gender'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $caste    = $_POST['r1'];       // caste (radio button or select box)
    $lang     = $_POST['language']; // checkbox multiple values
    $lang1    = implode(",", $lang); // convert array to string
    $address1 = $_POST['address'];

    // 2. Insert query (columns & values match)
    $qry = "INSERT INTO form 
            (std_image,fname, lname, pass, pass1, gender, email, phone, caste, language, address1) 
            VALUES 
            ('$folder','$fname', '$lname', '$pass', '$pass1', '$gender', '$email', '$phone', '$caste', '$lang1', '$address1')";

    // 3. Execute query
    if (mysqli_query($conn, $qry)) {
    echo "<script>alert('✅ Data inserted successfully.');</script>";
      echo '<meta http-equiv="refresh" content="0; url=http://localhost/stud/display.php" />';
        exit;
} else {
    echo "<script>alert('❌ Error inserting data: " . mysqli_error($conn) . "');</script>";
}

}
?>
