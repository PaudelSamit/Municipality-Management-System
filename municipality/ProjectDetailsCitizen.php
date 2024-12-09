
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
       <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-size: 18px;
            color: white; /* Change text color to white */
        }

        /* Add styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 2px solid #ddd;
        }

        th {
            background-color: #3e70a5; /* Header background color */
            color: white; /* Header text color */
            text-align: left; /* Header text alignment */
        }

        td {
            background-color: #a9b1bb; /* Row background color */
        }

        /* Alternate row color */
        tr:nth-child(even) {
            background-color: #326292;
        }

        /* Styles for top navigation */
        .topnav {
            overflow: hidden;
            background-color: #ad2727;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Center the content */
        .center {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 90%;
            margin: auto;
        }

        /* Add hover effect to buttons */
        button {
            margin: 0;
            padding: 14px 16px;
            background-color: rgb(245, 30, 30);
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #b61b1b;
        }
    </style>
</head>


<body>
<div class="topnav">
<a href="index.html" style="padding:0;">
    <img src="image/logo.png" height="45px" width="45px" alt="logo">
    </a>
<!-- <a class="active" href="ProjectDetails.php">Projects</a> -->

<span style="float:right;margin-right: 10px;">
  <a href="index.html">Home</a>
</span>
</div>
<div class="center">
<h2 style="text-align:center;color:#000000;">Udergoing Projects:</h2>


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

                    $row = $row."<tr>
                        <td>$no</td>
                        <td>$name</td>
                        <td>$department</td>
                        <td>$budget</td>
                        <td>$company</td>
                        <td>$location</td>
                        <td>$start</td>
                        <td>$end</td>
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
      <th>Project Location</td>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>".$s."
    </table>";
    ?>

</div>
  </body>

</html>