<?php
include 'conn1.php';
session_start();

if (isset($_POST['login'])) {
    $uname = trim($_POST['username']);
    $pwd   = trim($_POST['password']);

    // Query to check user (make sure column name is correct: pass OR password)
    $qry = "SELECT * FROM form WHERE email='$uname' AND pass='$pwd'";
    $data = mysqli_query($conn, $qry);
    $total = mysqli_num_rows($data);

    if ($total == 1) {
        $_SESSION['user_name'] = $uname;  // store username in session
        echo "<script>alert('✅ Login Successful! Welcome $uname');</script>";
        header("Location: display.php");
        exit;
    } else {
        echo "<script>alert('❌ Invalid Username or Password');</script>";
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login By Users</title>
  <link rel="stylesheet" href="login-style.css">
</head>
<body>
  <form action="login.php" method="POST" onsubmit="return loginUser(event)">
    <div class="center">
      <h1>Login</h1>
      <input type="text" id="username" name="username" class="text" placeholder="Username"><br>
      <input type="password" id="password" name="password" class="text" placeholder="Password">
      
      <div class="forgetpass"><a href="#" class="link">Forget Password?</a></div>
      <input type="submit" name="login" value="Login">
   
      <div class="signup">
        New Member? <a href="#" class="link">Sign Up Here</a>
      </div>
    </div>
  </form>

  <script>
    // Login Validation (Frontend)
    function loginUser(event) {
      const user = document.getElementById("username").value.trim();
      const pass = document.getElementById("password").value.trim();

      if (user === "" || pass === "") {
        alert("⚠️ Please fill in both fields.");
        event.preventDefault(); // stop form submission
        return false;
      }
      return true; // allow form to submit
    }
  </script>
</body>
</html>
