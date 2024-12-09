<?php
//include("simple_html_dom.php");
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location: login.php');
    exit;
}
?>

<html>
<head>
  <title>Add a Project</title>
  <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        form {
            border: 3px solid #f1f1f1;
            margin: 2% 20%;
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
        th, td
        {
            padding:0 15px;
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
        .main{

            margin: 8% 8% 2% 8%;
            display: flex;
            justify-content: center;
        }
        button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
     
    }
        
    input[type=text],
    input[type=int] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
      p{
          color:red;
          text-align: center;
          font-size: 12px;
      }
    </style>
    <script type="text/javascript">
           function func_pnum(){
               var pnum=document.getElementById("pnum").value;
               var reg=/^[0-9]{1,4}$/;
               if(!reg.test(pnum)){
                   document.getElementById("pnum").style.border="2px solid red";
                   document.getElementById("text1").innerHTML="Enter correct Project Number!!!";
               }
               else{
                   document.getElementById("pnum").style.border="2px solid green";
                   document.getElementById("text1").innerHTML="";
               }
           }
        function func_pname(){
               var pname=document.getElementById("pname").value;
               var reg=/^[a-zA-Z_]{4,}$/;
               if(!reg.test(pname)){
                   document.getElementById("pname").style.border="2px solid red";
                   document.getElementById("text2").innerHTML="Enter correct Project Name!!!";
               }
               else{
                   document.getElementById("pname").style.border="2px solid green";
                   document.getElementById("text2").innerHTML="";
               }
           }
        function func_dnum(){
               var dnum=document.getElementById("dnum").value;
               var reg=/^[0-9]{1,4}$/;
               if(!reg.test(dnum)){
                   document.getElementById("dnum").style.border="2px solid red";
                   document.getElementById("text3").innerHTML="Enter correct Department Number!!!";
               }
               else{
                   document.getElementById("dnum").style.border="2px solid green";
                   document.getElementById("text3").innerHTML="";
               }
           }
        function func_budget(){
               var budget=document.getElementById("budget").value;
               var reg=/^[0-9]{4,}$/;
               if(!reg.test(budget)){
                   document.getElementById("budget").style.border="2px solid red";
                   document.getElementById("text4").innerHTML="Enter correct budget of Project !!!";
               }
               else{
                   document.getElementById("budget").style.border="2px solid green";
                   document.getElementById("text4").innerHTML="";
               }
           }

           function func_pdone(){
            var portion=document.getElementById("portion").value;
               var reg=/^[0-9]{1,3}$/;
               if(!reg.test(portion)){
                   document.getElementById("portion").style.border="2px solid red";
                   document.getElementById("text5").innerHTML="Enter correct budget of Project !!!";
               }
               else{
                   document.getElementById("portion").style.border="2px solid green";
                   document.getElementById("text5").innerHTML="";
               }
           }
        
    </script>
</head>
<body>

<div class="topnav">
    <a href="index.html" style="padding:0;">
    <img src="image/logo.png" height="45px" width="45px" alt="logo">
    </a>

<a  href="adminpage.php">DataEntry</a>
<a href="update.php">UpdateData</a>
<a href="complains.php">Complains</a>
<a href="ProjectDetails.php">Projects</a>
<a class="active" href="AddProject.php">AddProjects</a>
<a href="viewdetails.php">Citizen Details</a>



<span style="float:right;margin-right: 10px;">
  <a href="reset.php">ResetPassword</a>
  <a href="login.php">Logout</a>
</span>
</div>
    

 <form  action="?" id="form1"  method="post">
    <label><b> Project Number:</b><b style="color:red;">*</b></label>
    <input type="text" name="number" id="pnum" onchange="func_pnum()" required><p id="text1"></p><br>

     <label><b> Project Name:</b><b style="color:red;">*</b></label>
    <input type="text" name="name" id="pname" onchange="func_pname()" required><p id="text2"></p><br>

    <label><b>  Department Number:</b><b style="color:red;">*</b></label>
    <input type="text" name="depart" id="dnum" onchange="func_dnum()" required><p id="text3"></p><br>

    <label><b> Budget: </b><b style="color:red;">*</b></label>
    <input type="number" name="budget" min="0" id="budget" onchange="func_budget()" required><p id="text4"></p><br>
    
    <label><b>  Project Company:</b><b style="color:red;">*</b></label>
     <input type="text" name="company" id="company" required><br>

    <label><b>Project Location: </b><b style="color:red;">*</b></label>
    <input type="text" name="location" id="location" required><br>

     <label><b>Project Done(%):</b></label>
     <input type="text" name="portion" id="portion" onchange="func_pdone()" required><p id="text5"></p><br>

    <label><b>  Start Date:</b><b style="color:red;">*</b></label>
    <input type="date" name="start" required>

    <span style="float:right;">
        <label><b> End Date:</b><b style="color:red;">*</b></label>
     <input type="date" name="end" required>
    </span>
    <br>
    <button type="submit" name="submit"> Submit</button>

    <?php
  $host="localhost";
  $dbusername="root";
  $dbpassword="";
  $dbanme="municipality";
  $conn=mysqli_connect($host, $dbusername, $dbpassword, $dbanme);
  
  
  if (!$conn){
      echo "Server is not connected";
  }

  if(isset($_POST['submit']))
  {
    $pno=$_POST['number'];
    $pname=$_POST['name'];
    $dname=$_POST['depart'];
    $budget=$_POST['budget'];
    $pcompany=$_POST['company'];
    $plocation=$_POST['location'];
    $pcompleted=$_POST['portion'];
    $sdate=$_POST['start'];
    $edate=$_POST['end'];
  

              
            $sql_query="insert into addproject (Project_No,Project_Name,Department_No,Budget,Project_Company,Project_Location,Project_Completed,Start_Date,End_Date)
                               values('$pno','$pname','$dname','$budget','$pcompany','$plocation','$pcompleted','$sdate','$edate')";
            $result=mysqli_query($conn,$sql_query);
           
                if($result){
                    $msg="Project Submitted Successfully !";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                   }
                   else{
                     echo "Error".$sql_query." ".mysqli_error($conn);
                   }
           
                            
  }
?>
</form>
</body>
</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>