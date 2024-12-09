
 <?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location: login.php');
}

?> 
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    form {
      border: 3px solid #f1f1f1;
      margin: 25px 15% 25px 15%;
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

    input[type=text],
    input[type=int] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
    
      width: 10%;
    }

    /* Add a hover effect for buttons */
    button:hover {
      opacity: 0.8;
    }

    /* Extra style for the cancel button (red) */
    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    /* Center the avatar image inside this container */
    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }

    /* Avatar image */
    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    /* Add padding to containers */
    .container {
      padding: 16px;
    }

    /* The "Forgot password" text */
    span.psw {
      float: right;
      padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
      p{
          color:red;
          text-align: center;
          font-size: 12px;
      }
  </style>
    <script type="text/javascript">
     function func_fname(){
              var name=document.getElementById("fname").value;
              var reg=/^[A-Z]{1}[a-z]{2,}$/;
              if(!reg.test(name)){
                  document.getElementById("text1").innerHTML="Enter Valid First Name!!!";
                  document.getElementById("fname").style.border="2px solid red";
              }
              else
                  {
                       document.getElementById("text1").innerHTML="";
                      document.getElementById("fname").style.border="2px solid green";
                  }
          }
            
        function func_lname(){
              var name=document.getElementById("lname").value;
              var reg=/^[a-zA-Z]{1,}$/;
              if(!reg.test(name)){
                  document.getElementById("text2").innerHTML="Enter Valid last Name!!!";
                  document.getElementById("lname").style.border="2px solid red";
              }
              else
                  {
                       document.getElementById("text2").innerHTML="";
                      document.getElementById("lname").style.border="2px solid green";
                  }
          }
        function func_citizenid(){
                 var cid=document.getElementById("citizen").value;
                var reg=/^[a-zA-Z0-9_]{6,15}$/;
               if(!reg.test(cid)){
                     document.getElementById("citizen").style.border="2px solid red";
                     document.getElementById("text3").innerHTML="Enter correct Citizen ID (6-15)character !!!";
                 }
              else{
                   document.getElementById("citizen").style.border="2px solid green";
                         document.getElementById("text3").innerHTML="";
              }
        }
        function func_phnum(){
              var pnum=document.getElementById("phnum").value;
              var reg=/^([+0-9]{1,3})?([0-9]{10,11})$/i;

              if(!reg.test(pnum)){
                  document.getElementById("text4").innerHTML="Enter Valid phone number!!!";
                  document.getElementById("phnum").style.border="2px solid red";
              }
              else
                  {
                       document.getElementById("text4").innerHTML="";
                      document.getElementById("phnum").style.border="2px solid green";
                  }
          }
        
        function func_zip(){
          var zcode=document.getElementById("code").value;
            var reg=/^[0-9]{5,9}$/;
            if(!reg.test(zcode)){
                 document.getElementById("text5").innerHTML="Enetr valid Zip Code!!!";
                      document.getElementById("code").style.border="2px solid green";
            }
            else
                {
                    document.getElementById("text5").innerHTML="";
                      document.getElementById("code").style.border="2px solid green";
                }
        }
        
        function checkOtherOption() {
            var selectBox = document.getElementsByName("purpose")[0];
            var otherText = document.getElementById("otherText");
            if (selectBox.value === "other") {
                otherText.style.display = "block";
            } else {
                otherText.style.display = "none";
            }
        }
    
    </script>
</head>

<body>

  <div class="topnav">
  <a href="index.html" style="padding:0;">
    <img src="image/logo.png" height="45px" width="45px" alt="logo">
    </a>
    <a class="active" href="adminpage.php">DataEntry</a>
    <a href="update.php">UpdateData</a>
    <a href="complains.php">Complains</a>
    <a href="ProjectDetails.php">Projects</a>
    <a href="AddProject.php">AddProjects</a>
    <a href="viewdetails.php">Citizen Details</a>


    <span style="float:right;margin-right: 10px;">
    <a href="register.html">Emp Register</a>
      <a href="reset.php">ResetPassword</a>
      <a href="index.html">Logout</a>
    </span>
  </div>
  <main>
    <form action="?>" method="post">
      <center>
        <h1 style="color:5e2222;">Welcome <?php echo $_SESSION["U"]; ?> </h2>
        <h2>Enter the details of Citizen</h1>
      </center>

      <div class="container">
        <label for="firstname"><b>First name</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter your first name" name="firstname" id="fname" onchange="func_fname()" required><p id="text1"></p><br><br>


        <label for="middlename"><b>Middle Name</b></label>
        <input type="text" placeholder="Enter Middle Name" name="middlename"><br><br>

        <label for="lastname"><b>Last Name</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter Last Name" name="lastname" id="lname" onchange="func_lname()" required><p id="text2"></p><br><br>

        <label for="familyname"><b>Family Name</b></label>
        <input type="text" placeholder="Enter Family Name" name="familyname"><br><br>

        <label for="dob"><b>Date of birth</b><b style="color:red;">*</b></label>
        <input type="date" placeholder="Enter Date_of_birth" name="dob" required><br><br>

        <label for="citizen_id"><b>Enter Citizen ID</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter CITIZEN_ID" name="citizenid" id="citizen" onchange="func_citizenid()" required><p id="text3"></p><br>

        

        <h4> Gender<b style="color:red;">*</b></h4>
        <select name="gender" type="text">
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">other</option>
        </select><br>
        <br>

        <label for="marriageid"><b>Enter Marriage ID (Leave Blank if Unmarried)</b></label>
        <input type="text" placeholder="Enter Marriage ID" name="marriageid"><br><br>

<!-- 
        <label for="phonenumber"><b>Phone Number</b><b style="color:red;">*</b></label>
        <input type="number" placeholder="Enter Phone Number" name="phonenumber" id="phnum" onchange="func_phnum()" required><p id="text4"></p><br><br> -->

        <label for="city"><b>City</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter City" name="city" required><br><br>

        <!-- <label for="zipcode"><b>Zip Code</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter Zip Code" name="zipcode" id="code" onchange="func_zip()" required><p id="text5"></p><br><br> -->

        <label for="housenumber"><b>Occupation</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter Occupation" name="housenumber" required><br><br>
        
        <label for="streetname"><b>Street Name</b><b style="color:red;">*</b></label>
        <input type="text" placeholder="Enter Street Name" name="streetname" required><br><br>

        <label for="streetnumber"><b>Date Of Visit</b><b style="color:red;">*</b></label>
        <input type="date" placeholder="Enter Date" name="streetnumber" required><br><br>
        
        <label for="phonenumber"><b>Phone Number</b><b style="color:red;">*</b></label>
        <input type="number" placeholder="Enter Phone Number" name="phonenumber" id="phnum" onchange="func_phnum()" required><p id="text4"></p>


        <h3>Purpose for Visit</h3>
        <select name="purpose" required onchange="checkOtherOption()">
        <option value="Data Entry">Purpose For Visit</option>
        <option value="National Identity Card">National Identity Card</option>
        <option value="business_license">Business License</option>
    <option value="parking_permits">Parking Permits</option>
    <option value="zoning_variances">Zoning Variances</option>
        <option value="qr">QR Making</option>
        <option value="digital_signature">Digital Signature Making</option>
        <option value="Building Permit">Building Permit</option>
        <option value="Property Tax">Property Tax</option>
        <option value="other">Other</option>
        <!-- Add more options as needed -->
    </select><br><br>
    <div id="otherText" style="display:none;">
        <label for="otherDescription">Please specify:</label>
        <input type="text" id="otherDescription" name="otherDescription">
    </div>


        <button type="submit" name="submit">Submit</button>
        

      </div>

      <?php
        $server="localhost";
        $username="root";
        $password="";
        $database_name="municipality";

        $conn=mysqli_connect( $server,$username,$password,$database_name);

        if(!$conn){
            echo "Server is not connected !";
        }

        if(isset($_POST['submit']))
        {
                   $firstname=$_POST['firstname'];
                   $middlename=$_POST['middlename'];
                   $lastname=$_POST['lastname'];
                   $familyname=$_POST['familyname'];
                   $dob=$_POST['dob'];
                   $citizenid=$_POST['citizenid'];
                   $gender=$_POST['gender'];
                   $marriageid=$_POST['marriageid'];
                   $phonenum=$_POST['phonenumber'];
                   $city=$_POST['city'];
                  //  $zipcode=$_POST['zipcode'];
                   $housenum=$_POST['housenumber'];
                   $streetname=$_POST['streetname'];
                   $streetnum=$_POST['streetnumber'];
                   $purpose=$_POST['purpose'];
                   $otherDescription = $_POST['otherDescription'];


// If "Other" is selected, append the description to the purpose
if ($purpose === "other" && !empty($otherDescription)) {
  $purpose = "Other: " . $otherDescription;
}
                   $s="select * from citizen_details where Citizen_ID='$citizenid' ";

             $result=mysqli_query($conn,$s);

              $row=mysqli_num_rows($result);

              if($row==1){
                     
                     echo "<script type='text/javascript'>alert('Citizen alredy exists');</script>";
                     
                       }

                       else{
                        $sql_query="insert into citizen_details (First_name,Middle_name,Last_name,Family_name,Date_of_Birth,Citizen_ID,Gender,Marriage_ID,Phone_Number,City,House_No,Street_Name,Street_Number,purpose)
                        values(' $firstname','$middlename',' $lastname','$familyname',' $dob','$citizenid','$gender','$marriageid','$phonenum',' $city',' $housenum','$streetname','$streetnum','$purpose')";
                    
                        $data=mysqli_query($conn,$sql_query);


                        if($data){
                            $message = "DATA ENTERED SUCCESFULLY ";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                          //  header("refresh:0; url:adminpage.php");
                          }
                          else
                          {
                           echo "Error".$sql_query." ".mysqli_error($conn);
                          } 
                       }

                  
        }
      ?>

    </form>

  </main>
</body>

</body>

</html>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>