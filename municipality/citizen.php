<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }        .container {
            text-align: center;
            color: white;
            margin: 15% 20%;
        }

        h3 {
            font-size: 30px;
            color: white;
            margin-bottom: 20px;
        }

        p {
            font-size: 25px;
            line-height: 2;
            margin-bottom: 15px;
            color: white;
        }

        c {
            color: red;
        }

        a {
            color: yellow;
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s ease-in-out;
        }

        a:hover {
            color: #ffd700; /* change to your preferred hover color */
        }


        form {
            border: 3px solid #f1f1f1;
            margin: 5% 10%;
            padding: 10px;
            background-color: rgb(164, 187, 187);
        }

        #hide{
            position: fixed;
            top:20%;
            left:20%;
            width:60%;
            z-index: 1;
            opacity:1;
            background-color: antiquewhite;
            border:solid #ddd;
            display: none;
        }
        

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: blue;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        button {
            margin: 0;
            padding: 14px 16px;
            background-color: red;
            color: white;
        }

        .btn:hover {
            background-color: #ddd;
            color: black;
        }
     
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }
        
    </style>
    <script type="text/javascript">
        function func_citizenid(){
            var id=document.getElementById("citizen").value;
            var reg=/^[a-zA-Z0-9_]{6,15}$/;
            if(!reg.test(id)){
                document.getElementById("citizen").style.border="2px solid red";
                document.getElementById("text").innerHTML="Enter correct Citizen ID (6-15) characters !!!";
            }
            else{
                document.getElementById("citizen").style.border="2px solid green";
                document.getElementById("text").innerHTML="";
            }
        }
    </script>
</head>

<body>

    <div class="topnav">
        <a href="index.html" style="padding:0;">
            <img src="image/logo.png" height="45px" width="45px" alt="logo">
        </a>
        <span style="float:right;margin-right: 10px;">
            <button class="btn" onclick="report()">Report</button>
        </span>
    </div>
    <div class="container">
        <h3>TO MAKE A COMPLAINT CLICK <c>REPORT</c> ON TOP-RIGHT CORNER!!!</h3>
        <p>
            If you encounter any issues or have suggestions, please feel free to submit a complaint using the <c>REPORT</c> button. Your feedback is valuable to us!
        </p>
        <p>
            <a href="index.html" style="font-size: 20px;">Go back to homepage</a>
        </p>
    </div>
    
    <div id="hide">
        <h2 style="text-align: center;"> Report your Complains here: </h2>
        <form id="report" action="?" method="post">
            <label for="citizen"><b>Citizen id:</b></label>
            <input type="text" name="citizenid" id="citizen" onchange="func_citizenid()" required><p id="text"></p>
            <br><br>
            <label for="subject"><b>Complain:</b></label><br>
            <textarea id="subject" placeholder="Write your complain here" name="complain" rows="5" cols="77"
                style="height:200px" required></textarea><br><br>
            <button  style="background-color:green;"  class="btn" type="submit" name="submit"><b>Submit</b></button>
            <button   class="btn" type="button" onclick="document.location='index.html'"><b>Cancel</b></button>
        </form>
    </div>

    <?php
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="municipality";
    $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    if (!$conn){
        echo "Server is not connected";
    }

    if(isset($_POST['submit']))
    {
        $cid=$_POST['citizenid'];
        $complain=$_POST['complain'];

        // Check if the citizen ID exists
        $sql="SELECT * FROM citizen_details WHERE Citizen_ID='$cid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($result);

        if($row==1){
            // If citizen ID exists, insert complaint
            $sql_query="INSERT INTO complains (Citizen_ID, Complain) VALUES ('$cid','$complain')";
            if(mysqli_query($conn,$sql_query)){
                $msg="Complaint Registered Successfully !";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            else{
                echo "Error: ".$sql_query." ".mysqli_error($conn);
            }
        }
        else{
            // If citizen ID doesn't exist, insert complaint with a status indicating it's for a new citizen
            $sql_query="INSERT INTO complains (Citizen_ID, Complain, Status) VALUES ('$cid','$complain', 'New Citizen')";
            if(mysqli_query($conn,$sql_query)){
                $msg="Complaint Registered Successfully for new citizen!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            else{
                echo "Error: ".$sql_query." ".mysqli_error($conn);
            }
        }
    }

    ?>

</body>

<script>
    function report() {
        var x=document.getElementById('hide');
        if (x.style.display == "none" || x.style.display == "")
            x.style.display='block';
        else
            x.style.display='none';
    }
</script>

</html>