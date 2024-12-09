<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login.php');
    exit;
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
         body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            font-size: 18px;
        }

        form {
            border: 3px solid #f1f1f1;
            padding: 10px;
            background-color: #3e70a5;
        }

        th, td {
            padding: 10px 15px;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 2px solid black;
            color: #e48410;
        }

        td {
            color: white;
            padding: 15px;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #f23030;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #f14f4f;
        }

        .topnav a:hover {
            background-color: #555;
        }

        .topnav a.active {
            background-color: #04AA6D;
        }

        .center {
            width: 90%;
            margin: auto;
        }

        .center h2 {
            text-align: center;
            color: #e48410;
            margin-top: 20px;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
        }

        .container table tr:nth-child(even) {
            background-color: #3e70a5;
        }

        .container table tr:hover {
            background-color: #5375ab;
        }

        .container table th {
            background-color: #5375ab;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
<div class="topnav">
<a href="index.html" style="padding:0;">
    <img src="image/logo.png" height="45px" width="45px" alt="logo">
    </a>
<a href="adminpage.php">DataEntry</a>
<a href="update.php">UpdateData</a>
<a href="complains.php">Complains</a>
<a class="active" href="ProjectDetails.php">Projects</a>
<a href="AddProject.php">AddProjects</a>
<a href="viewdetails.php">Citizen Details</a>

<span style="float:right;margin-right: 10px;">
  <a href="reset.php">ResetPassword</a>
  <a href="index.html">Logout</a>
</span>
</div>
<div class="center">
  <h2 style="text-align:center;color:#e48410;">Udergoing Projects:</h2>

  <?php

    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbanme="municipality";
    $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbanme);
    if(!$conn){
        echo "Database not connected";
    }
    
    $sql = "SELECT * from addProject ";

    
    function view($conn, $sql, $row){
        if($query = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($query) > 0){
                while($result = mysqli_fetch_array($query)){
                    $name  = $result['Project_Name'];
                    $no = $result['Project_No'];
                    $department = $result['Department_No'];
                    $budget = $result['Budget'];
                    $company = $result['Project_Company'];
                    $location = $result['Project_Location'];
                    $start = $result['Start_Date'];
                    $end = $result['End_Date'];

                    $row .= "<tr>
                    <td>$no</td>
                    <td>$name</td>
                    <td>$department</td>
                    <td>$budget</td>
                    <td>$company</td>
                    <td>$location</td>
                    <td>$start</td>
                    <td>$end</td>
                    <td>
                        <form method='post' action='delete_project.php' style='display:inline-block;'>
                            <input type='hidden' name='project_no' value='$no'>
                            <input type='submit' value='Delete'>
                        </form>
                        <form method='get' action='edit_project.php' style='display:inline-block;'>
                            <input type='hidden' name='project_no' value='$no'>
                            <input type='submit' value='Edit'>
                        </form>
                    </td>
                    </tr>";
                
                }
                mysqli_free_result($query);
            }
        }
        return $row;
    }
    $s = view($conn, $sql, "");
    echo "<table>
    <tr>
      <th>Project Number</th>
      <th>Project Name</th>
      <th>Department</th>
      <th>Budget</th>
      <th>Project Company</th>
      <th>Project Location</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Actions</th>
    </tr>".$s."
    </table>";
    ?>

</div>
  </body>

</html>
