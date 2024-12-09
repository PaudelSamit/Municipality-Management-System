<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}


$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "municipality";
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    echo "Database not connected";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $citizenid = $_POST['citizenid'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $familyname = $_POST['familyname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $marriageid = $_POST['marriageid'];
    $phonenum = $_POST['phonenum'];
    $city = $_POST['city'];
    $housenum = $_POST['housenum'];
    $streetname = $_POST['streetname'];
    $streetnum = $_POST['streetnum'];
    $purpose = $_POST['purpose'];

    $updateQuery = "UPDATE citizen_details SET 
        First_name = '$firstname', 
        Middle_name = '$middlename', 
        Last_name = '$lastname', 
        Family_name = '$familyname', 
        Date_of_Birth = '$dob', 
        Gender = '$gender', 
        Marriage_ID = '$marriageid', 
        Phone_Number = '$phonenum', 
        City = '$city', 
        House_No = '$housenum', 
        Street_Name = '$streetname', 
        Street_Number = '$streetnum', 
        purpose = '$purpose' 
        WHERE Citizen_ID = '$citizenid'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewdetails.php';</script>";
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    if (isset($_GET['citizenID'])) {
        $citizenid = $_GET['citizenID'];
        $result = mysqli_query($conn, "SELECT * FROM citizen_details WHERE Citizen_ID = '$citizenid'");
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No citizen ID provided.";
        exit;
    }
}

mysqli_close($conn);
?>

<html>

<head>
    <title>Edit Citizen Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>


<body>
    <div class="container">
        <h2>Edit Citizen Details</h2>
        <form method="POST" action="edit.php">
            <input type="hidden" name="citizenid" value="<?php echo $row['Citizen_ID']; ?>">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo isset($row['First_name']) ? $row['First_name'] : ''; ?>">

            <label for="middlename">Middle Name:</label>
            <input type="text" name="middlename" id="middlename" value="<?php echo isset($row['Middle_name']) ? $row['Middle_name'] : ''; ?>">

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo isset($row['Last_name']) ? $row['Last_name'] : ''; ?>">

            <label for="familyname">Family Name:</label>
            <input type="text" name="familyname" id="familyname" value="<?php echo isset($row['Family_name']) ? $row['Family_name'] : ''; ?>">

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="<?php echo isset($row['Date_of_Birth']) ? $row['Date_of_Birth'] : ''; ?>">

            <label for="gender">Gender:</label>
            <input type="text" name="gender" id="gender" value="<?php echo isset($row['Gender']) ? $row['Gender'] : ''; ?>">

            <label for="marriageid">Marriage ID:</label>
            <input type="text" name="marriageid" id="marriageid" value="<?php echo isset($row['Marriage_ID']) ? $row['Marriage_ID'] : ''; ?>">

            <label for="phonenum">Phone Number:</label>
            <input type="text" name="phonenum" id="phonenum" value="<?php echo isset($row['Phone_Number']) ? $row['Phone_Number'] : ''; ?>">

            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="<?php echo isset($row['City']) ? $row['City'] : ''; ?>">

            <label for="housenum">Occupation:</label>
            <input type="text" name="housenum" id="housenum" value="<?php echo isset($row['House_No']) ? $row['House_No'] : ''; ?>">

            <label for="streetname">Street Name:</label>
            <input type="text" name="streetname" id="streetname" value="<?php echo isset($row['Street_Name']) ? $row['Street_Name'] : ''; ?>">

            <label for="streetnum">Date Of Visit:</label>
            <input type="date" name="streetnum" id="streetnum" value="<?php echo isset($row['Street_Number']) ? $row['Street_Number'] : ''; ?>">

            <label for="purpose">Purpose:</label>
            <input type="text" name="purpose" id="purpose" value="<?php echo isset($row['purpose']) ? $row['purpose'] : ''; ?>">

            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>