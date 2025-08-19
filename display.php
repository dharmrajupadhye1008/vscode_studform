<?php
include 'conn1.php';
session_start();

// If not logged in, redirect back
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}
else{

echo "<h2 style='text-align:center'>Welcome " . $_SESSION['user_name'] . "</h2>";
}
// Fetch all records
$qry1 = "SELECT * FROM form";
$data = mysqli_query($conn, $qry1);
$count = mysqli_num_rows($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display</title>
    <style>
        body {
            background: #D071f9;
            font-family: Arial, sans-serif;
        }
        table {
            background-color: white;
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .Update, .Delete {
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 80px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .Delete {
            background-color: red;
        }
    </style>
</head>
<body>
<?php
if ($count > 0) {
    echo "<h2 align='center'><mark>Displaying All Records</mark></h2>";
    echo "<center><table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Caste</th>
                <th>Languages</th>
                <th>Address</th>
                <th colspan='2'>Operations</th>
            </tr>";
    while ($result = mysqli_fetch_assoc($data)) {
        echo "<tr>
                <td>{$result['id']}</td>
                <td><img src='{$result['std_image']}' height='100px'></td>
                <td>{$result['fname']}</td>
                <td>{$result['lname']}</td>
                <td>{$result['gender']}</td>
                <td>{$result['email']}</td>
                <td>{$result['phone']}</td>
                <td>{$result['caste']}</td>
                <td>{$result['language']}</td>
                <td>{$result['address1']}</td>
                <td><a href='update_design.php?id1={$result['id']}'><input type='button' value='Update' class='Update'></a></td>
                <td><a href='delete_design.php?id1={$result['id']}'><input type='button' value='Delete' class='Delete' onclick='return checkdelete()'></a></td>
              </tr>";
    }
    echo "</table></center>";
} else {
    echo "<h3 align='center'>🔍 No records found!</h3>";
}

 mysqli_close($conn);
?>

<a href="log-out.php"><input type="submit" name="" value="LogOut" style="background:blue; color:white;hight:35px,width:100px; margin-top:20px;font-size:18px;border-radius:5px; cursor:pointer;"></a>
<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this record?');
}
</script>
</body>
</html>
