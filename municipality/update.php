<?php
//include("simple_html_dom.php");
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location: login.php');
    session_destroy();
    
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        form {
            width: 50%;
            border: 3px solid #f1f1f1;
            margin: 5% auto;
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
            margin: 10px 0;
            padding: 10px 12px;
            background-color: #04AA6D;
            color: white;
        }
        select {
        width: 160px;
        padding: 3px;
        
    }
    select:focus {
        min-width: 150px;
        width: auto;
    }
 p{
            color:red;
            text-align: center;
            font-size: 12px
        }
    </style>
 <script type="text/javascript">
   function func_citizenid(){
       var id=document.getElementById("citizen").value;
        var reg=/^[a-zA-Z0-9_]{6,15}$/;
       if(!reg.test(id)){
           document.getElementById("citizen").style.border="2px solid red";
           document.getElementById("text").innerHTML="Enter correct Citizen ID (6-15)character !!!";
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

<a  href="adminpage.php">DataEntry</a>
<a class="active" href="update.php">UpdateData</a>
<a href="complains.php">Complains</a>
<a href="ProjectDetails.php">Projects</a>
<a  href="AddProject.php">AddProjects</a>
<a href="viewdetails.php">Citizen Details</a>




<span style="float:right;margin-right: 10px;">
  <a href="reset.php">ResetPassword</a>
  <a href="index.html">Logout</a>
</span>
</div>
    <h1 style="text-align: center;color: white"> Update the attribute you want</h1>
    
    <form action="?" method="post">
        <h3> Input the Citizenid Present in Record</h3>
        <input type="text" name="citizenid" id="citizen" onchange="func_citizenid()" required><p id="text"></p><br>

        
        <h3>Select the attribute you want to update</h3>

        <select name ="name" id="select" >
                        
        <option value="ID_No" >Citizen_ID</option>
            <option value="First_name">First Name</option>
            <option value="Middle_name">Middle Name</option>
            <option value="Last_name">Last Name</option>
            <option value="Family_name">Family Name</option>
            <option value="Gender">Gender</option>
            <option value="City">City</option>
            <!-- <option value="zip_Code">Zip Code</option> -->
            <option value="Street_Name">streetname</option>
            <option value="Street_Number">street number</option>
            <option value="House_No">housenumber</option>
            <option value="Day_of_Birth">Date of birth</option>
            <option value="Phone_Number">Phone Number</option>
            <option value="Marrige_ID">Marrige ID</option>
            
          </select>
          <h3>Enter the value to be kept in record</h3>
          <input type="text" name="value" id="val" ><p id="text1"></p><br>
          <button type="submit" name="submit" >submit</button>
          <a href="viewdetails.php">View Details</a>
      

       
       <?php



$citizenid=@$_POST['citizenid'];
$value=@$_POST['value'];
$update=@$_POST['name'];

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="municipality";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);

$count=0;
if(!$conn)
{
    echo "Server is not connected";
}

if(isset($_POST["submit"]))
{
    
    if($update=="First_name")
    {
     if (!preg_match("/^[a-zA-Z]*$/",$value)) {
     
         $msg="Please,enter the valid first name";
         echo "<script type='text/javascript'>alert('$msg');</script>";
        // echo "<p><font color=red> <b>Please,enter the valid first name</b></font></p>";
        $count++;
    }
}
if($update=="Middle_name")
{
    if (!preg_match("/^[a-zA-Z]*$/",$value)) {
        $msg="Please,enter the valid middle name";
        echo "<script type='text/javascript'>alert('$msg');</script>";            
        //echo "<p><font color=red> <b>Please,enter the valid middle name</b></font></p>";
      
        $count++;
    }
}
if($update=="Last_name")
{
    if (!preg_match("/^[a-zA-Z]*$/",$value)) {
        $msg="Please,enter the valid last name";
        echo "<script type='text/javascript'>alert('$msg');</script>";           
        //echo "<p><font color=red> <b>Please,enter the valid last name</b></font></p>";
        $c=1;
        $count++;
    }
}
if($update=="Family_name")
{
if (!preg_match("/^[a-zA-Z]*$/",$value)) {
    $msg="Please,enter the valid family name";
    echo "<script type='text/javascript'>alert('$msg');</script>";                    
    //echo "<p><font color=red> <b>Please,enter the valid family name</b></font></p>";
    $count++;
    
}
}

if($update=="Citizen_ID")
{
    if (!preg_match("/^[0-9]*$/",$value)) {
        $msg="Please,enter the valid citizenid";
        echo "<script type='text/javascript'>alert('$msg');</script>";                    
       // echo "<p><font color=red> <b>Please,enter the valid citizenid </b></font></p>";
        $count++;
        
    }
}
if($update=="Phone_Number")
{
    
    if (!preg_match("/^[+]{0,1}[0-9]{0,13}$/",$value)) {
        $msg="Please,enter the valid phonenumber";
         echo "<script type='text/javascript'>alert('$msg');</script>";
        //echo "<p><font color=red> <b>Enter the valid phonenumber</b></font></p>";
       
       
        $count++;
   }
}

   

   
if($update=="Date_of_Birth")
{
   if ((date("Y-m-d") < $value  ) || (date("Y-m-d") =='$value')) {
    $msg="Please,enter the valid Date of Birth";
         echo "<script type='text/javascript'>alert('$msg');</script>";
         //echo "<p><font color=red> <b>Enter the valid Date of Birth</b></font></p>";
    $count++;
       }
    }
if($update=="Gender")
    {
        $value=strtolower($value);
        if(!preg_match("/^female$/",$value) && !preg_match("/^male$/",$value) && !preg_match("/^other$/",$value))
        {
            $msg="Please,enter the valid first Gender";
          echo "<script type='text/javascript'>alert('$msg');</script>";
           // echo "<p><font color=red> <b>Enter the valid Gender</b></font></p>";
            $count++;
        }
    }
 if($update=="Marrige_ID")
    {
        if (!preg_match("/^[0-9]*$/",$value)) {
            $msg="Please,enter the valid marriageID";
            echo "<script type='text/javascript'>alert('$msg');</script>";  
            //echo "<p><font color=red> <b>Please,enter the valid marriageid </b></font></p>";
           
            $count++;
        }
    }
    if($update=="House_No")
    {
        $d=2;
        if (!preg_match("/^[0-9]*$/",$value)) {
            $msg="Please,enter the valid phone number ";
            echo "<script type='text/javascript'>alert('$msg');</script>";                  
           // echo "<p><font color=red> <b>Please,enter the valid house number </b></font></p>";
           
            $count++;
          }
    }
    if($update=="City")
    {
       
        if (!preg_match("/^[a-zA-Z]*$/",$value)) {
            $msg="Please,enter the valid city";
            echo "<script type='text/javascript'>alert('$msg');</script>";         
           // echo "<p><font color=red> <b>Please,enter the valid city</b></font></p>";
            $c=1;
            $count++;
        }
    }

    // if($update=="Zip_Code")
    // {
      
    //     if (!preg_match("/^[0-9]*$/",$value)) {
    //         $msg="Please,enter the valid zip code";
    //         echo "<script type='text/javascript'>alert('$msg');</script>";                    
    //       //  echo "<p><font color=red> <b>Please,enter the valid zip code </b></font></p>";
          
    //         $count++;
    //       }
    // }
    if($update=="Street_Name")
    {
        
        if (!preg_match("/^[a-zA-Z]*$/",$value)) {
            $msg="Please,enter the valid street name<";
            echo "<script type='text/javascript'>alert('$msg');</script>";
           // echo "<p><font color=red> <b>Please,enter the street name</b></font></p>";
           
            $count++;
          }
    }
    if($update=="Street_Number")
    {
        
if (!preg_match("/^[0-9]*$/",$value)) {
    $msg="Please,enter the valid street number";
    echo "<script type='text/javascript'>alert('$msg');</script>";                           
   // echo "<p><font color=red> <b>Please,enter the valid street number</b></font></p>";
   
    $count++;
  }
    }

if($count==0){
    $sql="Update citizen_details set $update='$value' where Citizen_ID=$citizenid;";


    if(mysqli_query($conn,$sql))
    {
        
        $message = "DATA UPDATED SUCCESFULLY ";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
        
        $message = "ERROR OCCURED";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}

    
}

?>
    </form>

</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>