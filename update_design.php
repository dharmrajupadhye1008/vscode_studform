<?php
error_reporting(0);
include 'conn1.php';  // DB connection

 
session_start();

// If not logged in, redirect back
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}
else{

echo "<h2 style='text-align:center'>Welcome " . $_SESSION['user_name'] . "</h2>";
}



// Get record ID from query string
$ans = $_GET['id1'] ?? null;

// If form submitted
if (isset($_POST['on'])) {
    $fname    = $_POST['fname'];
    $lname    = $_POST['lname'];
    $pass     = $_POST['pass'];
    $pass1    = $_POST['pass1'];
    $gender   = $_POST['gender'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $caste    = $_POST['caste'] ?? '';   // caste from radio
   $lang     = $_POST['language']; // checkbox multiple values
    $lang1    = implode(",", $lang); // convert array to string
    $address1 = $_POST['address'];

    // Update record
    $qry = "UPDATE form 
            SET fname='$fname', lname='$lname', pass='$pass', pass1='$pass1', 
                gender='$gender', email='$email', phone='$phone', caste='$caste',language='$lang1', address1='$address1'
            WHERE id='$ans'";

    $data = mysqli_query($conn, $qry);
    if ($data) { 
        echo "<script>alert('Record Updated!')</script>";
        echo '<meta http-equiv="refresh" content="0; url=http://localhost/stud/display.php" />';
        exit;
    } else {
        echo "Failed to Update!";
    }
}

// Fetch data to show in the form
$qry1 = "SELECT * FROM form WHERE id = '$ans'";
$data = mysqli_query($conn, $qry1);
$result = mysqli_fetch_assoc($data);


$language = $result['language'];
$language1 = explode(",",$language);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP CRUD OPERATIONS</title>
  <link rel="stylesheet" href="style.css">
  <style>
    * { padding: 0; margin: 0; box-sizing: border-box; }
    body { background-color: #D071F9; padding: 0 10px; font-family: Arial, sans-serif; }
    .container { border: 2px solid black; max-width: 500px; background: white; margin: 20px auto; padding: 30px; box-shadow: 1px 2px 10px rgba(0,0,0,0.25); border-radius: 5px; }
    .title { font-size: 15px; font-weight: 700; margin-bottom: 25px; color: #D071F9; text-align: center; text-transform: uppercase; }
    .form .input_field { margin-bottom: 15px; display: flex; align-items: center; }
    .form .input_field label { width: 200px; margin: 10px; font-size: 14px; }
    .input, .input2 { width: 100%; border: 1px solid #D071F9; font-size: 15px; padding: 8px 10px; border-radius: 3px; outline: none; }
    .input2 { height: 100px; resize: none; }
    .input1 { position: relative; width: 100%; height: 37px; }
    .input1 select { width: 100%; height: 100%; padding: 8px 10px; border: 1px solid #D071F9; border-radius: 3px; outline: none; appearance: none; }
    .input1:before { content: ""; position: absolute; top: 12px; right: 10px; border: 8px solid transparent; border-top-color: #D071F9; pointer-events: none; }
    .input:focus, .input1 select:focus, .input2:focus { border-color: #007bff; }
    .btn { background: #D071F9; color: #fff; border: none; padding: 12px; font-size: 16px; border-radius: 3px; width: 100%; cursor: pointer; }
    .btn:hover { background: purple; }
  </style>
</head>
<body>
  <div class="container">
    <div class="title"><h1>UPDATE STUDENT DETAILS</h1></div>
    <form class="form" method="post" onsubmit="return validateForm()">
      
      <div class="input_field">
        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $result['fname'] ?? ''; ?>" class="input" required>
      </div>
      
      <div class="input_field">
        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $result['lname'] ?? ''; ?>" class="input" required>
      </div>
      
      <div class="input_field">
        <label>Password:</label>
        <input type="password" name="pass" value="<?php echo $result['pass'] ?? ''; ?>" class="input" required>
      </div>
      
      <div class="input_field">
        <label>Confirm Password:</label>
        <input type="password" name="pass1" value="<?php echo $result['pass1'] ?? ''; ?>" class="input" required>
      </div>
      
      <div class="input_field">
        <label>Gender:</label>
        <div class="input1">
          <select name="gender" required>
            <option value="">Select</option>
            <option value="Male"   <?php if(($result['gender'] ?? '')=='Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if(($result['gender'] ?? '')=='Female') echo 'selected'; ?>>Female</option>
            <option value="Other"  <?php if(($result['gender'] ?? '')=='Other') echo 'selected'; ?>>Other</option>
          </select>
        </div>
      </div>
      
      <div class="input_field">
        <label>Email Address:</label>
        <input type="email" name="email" value="<?php echo $result['email'] ?? ''; ?>" class="input" required>
      </div>
      
      <div class="input_field">
        <label>Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $result['phone'] ?? ''; ?>" class="input" pattern="[0-9]{10}" required>
      </div>
      
      <div class="input_field">
        <label style="margin-right:100px">Caste:</label>
        <input type="radio" name="caste" value="General"  style="margin-left:5px"<?php if(($result['caste'] ?? '')=="General") echo "checked"; ?>> 
        <label for="" style="margin-left:5px">General</label>
        <input type="radio" name="caste" value="OBC"  style="margin-left:5px"   <?php if(($result['caste'] ?? '')=="OBC") echo "checked"; ?>><label for="" style="margin-left:5px">OBC</label> 
        <input type="radio" name="caste" value="SC"  style="margin-left:5px"    <?php if(($result['caste'] ?? '')=="SC") echo "checked"; ?>> <label for="" style="margin-left:5px">SC</label>
        <input type="radio" name="caste" value="ST"  style="margin-left:5px"    <?php if(($result['caste'] ?? '')=="ST") echo "checked"; ?>> <label for="" style="margin-left:5px">ST</label>
      </div>
      
<div class="input_field">
  <label for="caste" style="margin-right:100px">Language:</label>

  <!-- English -->
  <input type="checkbox" name="language[]" value="English"
    <?php if (!empty($language1) && in_array("English", $language1)) echo "checked"; ?>>
  <label style="margin-left:5px">English</label>

  <!-- Marathi -->
  <input type="checkbox" name="language[]" value="Marathi"
    <?php if (!empty($language1) && in_array("Marathi", $language1)) echo "checked"; ?>>
  <label style="margin-left:5px">Marathi</label>

  <!-- Hindi -->
  <input type="checkbox" name="language[]" value="Hindi"
    <?php if (!empty($language1) && in_array("Hindi", $language1)) echo "checked"; ?>>
  <label style="margin-left:5px">Hindi</label>
</div>


      <div class="input_field">
        <label>Address:</label>
        <textarea class="input2" name="address" required><?php echo $result['address1'] ?? ''; ?></textarea>
      </div>
      
      <div class="input_field">
        <input type="submit" value="Update Details" class="btn" name="on">
      </div>
    </form>
  </div>

<script>
function validateForm() {
  const pass = document.querySelector('[name="pass"]').value;
  const confirmPass = document.querySelector('[name="pass1"]').value;
  if (pass !== confirmPass) {
    alert("Passwords do not match!");
    return false;
  }
  return true;
}
</script>
</body>
</html>
