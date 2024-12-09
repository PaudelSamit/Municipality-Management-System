<?php
//include("simple_html_dom.php");
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location:login.php');
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        form {
            /* border: 3px solid #f1f1f1; */
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }
        .show{
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
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
            color: #f2f2f2;
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
            color: black;

        }
        table, th, td{
            border: 2px solid black;
            border-collapse: collapse;
            border-color:green;
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
        <a class="active" href="complains.php">Complains</a>
        <a href="ProjectDetails.php">Projects</a>
        <a href="AddProject.php">AddProjects</a>
        <a href="viewdetails.php">Citizen Details</a>

        <span style="float:right;margin-right: 10px;">
            <a href="reset.php">ResetPassword</a>
            <a href="index.html">Logout</a>
        </span>
    </div>

    <form id="citizen" action="?" method="post">
        <button type="submit" name="view">ViewComplains</button>
    </form>

    <div class="show">

        <?php
        $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="municipality";
        $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbname);

        if (!$conn){
            echo "Server is not connected";
        }

        if(isset($_POST["delete"]))
        {  
            $delete_id = $_POST["delete_id"];
            $delete_query = "DELETE FROM complains WHERE Citizen_ID = '$delete_id'";
            mysqli_query($conn, $delete_query);
        }

        if(isset($_POST["view"]))
        {  
            $sql="SELECT * FROM complains";

            function view($conn, $sql, $row)
            {
                $i=0;
                if($query = mysqli_query($conn, $sql))
                {
                    if(mysqli_num_rows($query) > 0)
                    {
                        while($result = mysqli_fetch_array($query)){
                            $i=$i+1;
                            $cid  = $result['Citizen_ID'];
                            $comp = $result['Complain'];
                            $status = $result['Status'];

                            $status_display = $status == 'Read' ? 'Read' : 'Unread';

                            $row .= "<tr>
                                <td>$i</td>
                                <td>$cid</td>
                                <td>$comp</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='delete_id' value='$cid'>
                                        <button type='submit' name='delete'>Delete</button>
                                    </form>
                                </td>
                                <td>$status_display</td>
                                <td>";

                            if($status != 'Read'){
                                $row .= "<form action='' method='post'>
                                            <input type='hidden' name='mark_as_read_id' value='$cid'>
                                            <button type='submit' name='mark_as_read'>Mark as Read</button>
                                        </form>";
                            }

                            $row .= "</td>
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
                    <th>S.No.</th>
                    <th>Citizen ID</th>
                    <th>Complain</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>Mark as Read</th>
                </tr>".$s."
            </table>";

            mysqli_close($conn);
        }

        if(isset($_POST["mark_as_read"]))
        {  
            $mark_as_read_id = $_POST["mark_as_read_id"];
            $update_query = "UPDATE complains SET Status = 'Read' WHERE Citizen_ID = '$mark_as_read_id'";
            mysqli_query($conn, $update_query);
            header("Location: ".$_SERVER['PHP_SELF']); // Refresh the page to reflect changes
        }
        ?>

    </div>

</body>
</html>