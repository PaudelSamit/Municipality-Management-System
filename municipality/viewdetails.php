<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .modal {
            display: block;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid white;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            color: white;
        }

        form {
            padding: 10px;
        }

        .show {
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }

        body {
            margin: 0;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        button {
            padding: 6px;
            margin: 4px;
            background-color: #04AA6D;
            color: white;
        }

        button:hover {
            background-color: #ddd;
            color: white;
        }

        table,
        th {
            border: 5px solid black;
            margin: 5px;
            padding: 5px;
            border-color: black;
            color: white;
        }

        table,
        td {
            border: 3px solid black;
            border-collapse: collapse;
            border-color: black;
            color: white;
            padding: 10px;
            margin: 5px;
        }
    </style>
    <script>
        function showDetails(firstName, lastName, dob, citizenID, gender, marriageID, phoneNum, city, houseNum, streetName, streetNum) {
            var modal = document.createElement("div");
            modal.className = "modal";

            var modalContent = document.createElement("div");
            modalContent.className = "modal-content";

            var detailsTable = "<table>" +
                "<tr><td>First Name:</td><td>" + firstName + "</td></tr>" +
                "<tr><td>Last Name:</td><td>" + lastName + "</td></tr>" +
                "<tr><td>Date of Birth:</td><td>" + dob + "</td></tr>" +
                "<tr><td>Citizen ID:</td><td>" + citizenID + "</td></tr>" +
                "<tr><td>Gender:</td><td>" + gender + "</td></tr>" +
                "<tr><td>Marriage ID:</td><td>" + marriageID + "</td></tr>" +
                "<tr><td>Phone Number:</td><td>" + phoneNum + "</td></tr>" +
                "<tr><td>City:</td><td>" + city + "</td></tr>" +
                "<tr><td>Occupation:</td><td>" + houseNum + "</td></tr>" +
                "<tr><td>Street Name:</td><td>" + streetName + "</td></tr>" +
                "<tr><td>Date OF Visit:</td><td>" + streetNum + "</td></tr>" +
                "</table>";

            modalContent.innerHTML += detailsTable;
            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    document.body.removeChild(modal);
                }
            };
        }

        function editDetails(citizenID) {
            window.location.href = 'edit.php?citizenID=' + citizenID;
        }

        function deleteDetails(citizenID) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = 'delete.php?citizenID=' + citizenID;
            }
        }
    </script>
</head>

<body>

    <div class="topnav">
        <a href="index.html" style="padding:0;">
            <img src="image/logo.png" height="45px" width="45px" alt="logo">
        </a>
        <a href="adminpage.php">DataEntry</a>
        <a href="update.php">UpdateData</a>
        <a href="complains.php">Complains</a>
        <a href="ProjectDetails.php">Projects</a>
        <a href="AddProject.php">AddProjects</a>
        <a class="active" href="viewdetails.php">Citizen Details</a>
        <span style="float:right;margin-right: 10px;">
            <a href="reset.php">ResetPassword</a>
            <a href="index.html">Logout</a>
        </span>
    </div>

    <div class="center">
        <h2 style="text-align:center;color: #f5f0f0;">Citizen Details:</h2>

        <form method="GET" action="">
            <input type="text" name="name" placeholder="Search by name">
            <input type="text" name="occupation" placeholder="Search by occupation">
            <select name="gender">
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="text" name="street" placeholder="Search by street name">
            <button type="submit">Search</button>
        </form>

        <?php
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "municipality";
        $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

        if (!$conn) {
            echo "Database not connected";
        }

        $sql = "SELECT * from citizen_details WHERE 1=1";

        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $name = $_GET['name'];
            $sql .= " AND (First_name LIKE '%$name%' OR Last_name LIKE '%$name%')";
        }
        if (isset($_GET['occupation']) && !empty($_GET['occupation'])) {
            $occupation = $_GET['occupation'];
            $sql .= " AND House_No LIKE '%$occupation%'";
        }
        if (isset($_GET['gender']) && !empty($_GET['gender'])) {
            $gender = $_GET['gender'];
            $sql .= " AND Gender = '$gender'";
        }
        if (isset($_GET['street']) && !empty($_GET['street'])) {
            $street = $_GET['street'];
            $sql .= " AND Street_Name LIKE '%$street%'";
        }

        function view($conn, $sql)
        {
            $output = "";
            if ($query = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_array($query)) {
                        $firstname = $result['First_name'];
                        $middlename = $result['Middle_name'];
                        $lastname = $result['Last_name'];
                        $familyname = $result['Family_name'];
                        $dob = $result['Date_of_Birth'];
                        $citizenid = $result['Citizen_ID'];
                        $gender = $result['Gender'];
                        $marriageid = $result['Marriage_ID'];
                        $phonenum = $result['Phone_Number'];
                        $city = $result['City'];
                        $housenum = $result['House_No'];
                        $streetname = $result['Street_Name'];
                        $streetnum = $result['Street_Number'];
                        $purpose = $result['purpose'];

                        $output .= "<tr>
                             <td>$firstname</td>
                             <td>$middlename</td>
                             <td>$lastname</td>
                             <td>$familyname</td>
                             <td>$dob</td>
                             <td>$citizenid</td>
                             <td>$gender</td>
                             <td>$marriageid</td>
                             <td>$phonenum</td>  
                             <td>$city</td> 
                             <td>$housenum</td>
                             <td>$streetname</td>
                             <td>$streetnum</td>
                             <td>$purpose </td>
                             <td>
                                <button onclick=\"showDetails('$firstname', '$lastname', '$dob', '$citizenid', '$gender', '$marriageid', '$phonenum', '$city', '$housenum', '$streetname', '$streetnum')\">
                                    View Details
                                </button>
                                <button onclick=\"editDetails('$citizenid')\">
                                    Edit
                                </button>
                                <button onclick=\"deleteDetails('$citizenid')\">
                                    Delete
                                </button>
                            </td>
                        </tr>";
                    }
                    mysqli_free_result($query);
                }
            }
            return $output;
        }

        $tableContent = view($conn, $sql);

        echo "<table>
                <tr>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Family Name</th>
                  <th>Date of Birth</th>
                  <th>Citizen ID</th>
                  <th>Gender</th>
                  <th>Marriage ID</th>
                  <th>Phone Number</th>  
                  <th>City</th> 
                  <th>Occupation</th>
                  <th>Street Name</th>
                  <th>Date Of Visit</th>
                  <th>Purpose</th>
                  <th>Action</th>
                </tr>" . $tableContent . "
                </table>";

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
