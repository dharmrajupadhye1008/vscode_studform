<?php 
  // Database connection
  include 'conn1.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP CRUD OPERATIONS</title>
  
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #D071F9;
      padding: 0 10px;
      font-family: Arial, sans-serif;
    }

    .container {
      border: 2px solid black;
      max-width: 500px;
      background-color: white;
      margin: 20px auto;
      padding: 30px;
      box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.25);
    }

    .container .title {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 25px;
      color: #D071F9;
      text-transform: uppercase;
      text-align: center;
    }

    .form .input_field {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }

    .form .input_field label {
      width: 200px;
      margin: 10px;
      font-size: 14px;
    }

    .input, .input2 {
      width: 100%;
      border: 1px solid #D071F9;
      font-size: 15px;
      padding: 8px 10px;
      border-radius: 3px;
      outline: none;
      transition: all 0.3s ease;
    }

    .input2 {
      height: 100px;
      resize: none;
    }

    .input1 {
      position: relative;
      width: 100%;
      height: 37px;
    }

    .input1 select {
      width: 100%;
      height: 100%;
      padding: 8px 10px;
      border: 1px solid #D071F9;
      border-radius: 3px;
      outline: none;
      appearance: none;
    }

    .input1:before {
      content: "";
      position: absolute;
      top: 12px;
      right: 10px;
      border: 8px solid transparent;
      border-top-color: #D071F9;
      pointer-events: none;
    }

    .input:focus, .input1 select:focus, .input2:focus {
      border-color: #007bff;
    }

    .form .input_field p {
      font-size: 15px;
      color: #757575;
      margin-left: 10px;
    }

    .check {
      width: 15px;
      height: 15px;
      position: relative;
      margin-left: 10px;
    }

    .check input[type="checkbox"] {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }

    .check .checkmark {
      width: 15px;
      height: 15px;
      border: 1px solid #D071F9;
      display: block;
      position: relative;
    }

    .check .checkmark:before {
      content: "";
      position: absolute;
      top: 1px;
      left: 2px;
      width: 5px;
      height: 2px;
      border: 2px solid white;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      display: none;
    }

    .check input[type="checkbox"]:checked ~ .checkmark {
      background: red;
    }

    .check input[type="checkbox"]:checked ~ .checkmark:before {
      display: block;
    }

    .btn {
      background: #D071F9;
      color: #fff;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 3px;
      width: 100%;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: purple;
    }
    
 
      .btn:hover {
      background: purple;
    }

    @media (max-width: 420px) {
      .form .input_field {
        flex-direction: column;
        align-items: flex-start;
      }

      .form .input_field label {
        margin: 5px;
      }

      .form .input_field.terms {
        flex-direction: row;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">
      <h1>Registration Form</h1>
    </div>

    <!-- Form -->
    <form class="form" method="post" action="insert.php"  enctype="multipart/form-data" onsubmit="return validateForm()">


      <div class="input_field" >
      <label for="std_image">Upload Image:</label>
      <input type="file" name="file" style="width:100%;" > 
     </div>

      <div class="input_field">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" class="input" required>
      </div>

      <div class="input_field">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" class="input" required>
      </div>

      <div class="input_field">
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" class="input" required>
      </div>

      <div class="input_field">
        <label for="pass1">Confirm Password:</label>
        <input type="password" name="pass1" id="pass1" class="input" required>
      </div>

      <div class="input_field">
        <label for="gender">Gender:</label>
        <div class="input1">
          <select name="gender" id="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>

      <div class="input_field">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" class="input" required>
      </div>

      <div class="input_field">
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" class="input" pattern="[0-9]{10}" required>
      </div>

      <!-- Caste (Optional) -->
  <div class="input_field"> <label for="caste" style="margin-right:100px">Cast:</label>
   <input type="radio" name="r1" value="General" required><label for="" style="margin-left:5px">General</label>
    <input type="radio" name="r1" value="OBC" required><label for="" style="margin-left:5px">OBC</label> <input type="radio" name="r1" value="SC" required><label for="" style="margin-left:5px">SC</label>
    <input type="radio" name="r1" value="ST" required><label for="" style="margin-left:5px">ST</label> </div>


    
  <div class="input_field"> <label for="caste" style="margin-right:100px">Language:</label>
  <input type="checkbox" name="language[]" value="English"><label for="" style="margin-left:5px">English</label>
  <input type="checkbox" name="language[]" value="Marathi"><label for="" style="margin-left:5px">Marathi</label> <input type="checkbox" name="language[]" value="Hindi"><label for="" style="margin-left:5px">Hindi</label>
  </div>

      <div class="input_field">
        <label for="address">Address:</label>
        <textarea class="input2" name="address" id="address" required></textarea>
      </div>

      <div class="input_field terms">
        <label class="check">
          <input type="checkbox" name="agree" id="agree" required>
          <span class="checkmark"></span>
        </label>
        <p>Agree to terms and conditions</p>
      </div>

      <div class="input_field">
        <input type="submit" value="Register" class="btn" name="save">
      </div>
    </form>
  </div>

  <!-- JS Validation -->
  <script>
    function validateForm() {
      const pass = document.getElementById("pass").value;
      const confirmPass = document.getElementById("pass1").value;

      if (pass !== confirmPass) {
        alert("Passwords do not match!");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>


