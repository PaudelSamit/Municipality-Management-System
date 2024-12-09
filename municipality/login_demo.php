<?php if(isset($_SESSION['username'])){
    header("location: adminpage.php");
    exit;
  }
  ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;
background-color: aquamarine;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(315deg, rgb(55, 73, 112) 60%, rgb(51, 102, 96) 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
.form{
    margin: auto;
    height: 70%;
    width: 50%;
}

button {
  background-color: #04AA6D;
  /* background: linear-gradient(90deg, rgba(9, 112, 9, 0.473),green); */
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: auto;
}

img.avatar {
  border-radius: 50%;
}

.container {
  padding: 16px;
}

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
</style>
</head>
<body>

<h2 style="text-align: center;">Login Form</h2>
<div class="form">
    
<form action="?" method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.png" height="150px" width="150px" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Employee ID</b></label>
    <input type="text" placeholder="Enter Employee ID" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color: aquamarine;">
    <button type="button" class="cancelbtn" onclick="document.location='index.html'">Cancel</button>
  </div>


  <?php
  

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="municipality";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);


if(!$conn)
{
    echo "Server is not connected";

}


if(isset($_POST["submit"]))
{
  $username=$_POST['uname'];
  $password=$_POST['psw'];
$sql="SELECT * from register where USERNAME='$username' and PASSWORD='$password' ";

 $data=mysqli_query($conn, $sql);
 if($data){
 $result=mysqli_fetch_assoc($data);
 $total=mysqli_num_rows($data);

if($total>0)
{
  
  //$hashed=password_hash($password,PASSWORD_DEFAULT);
  // password_verify($password,$result["password"])

if($result["USERNAME"]==$username && password_verify($password,$result["PASSWORD"]))
//if($result["E_ID"]==$username && $password==$result["Password"])
{
  session_start();
  $_SESSION["USERNAME"]=$username;
  //$_SESSION["id"]=$id;
  $_SESSION["loggedin"]=true;

  //redirect to home page
  

// header("refresh:0;url=index.html");
header("location: adminpage.php");

}
else{
    $message = "Username and/or Password incorrect.Try again.";
  echo "<script type='text/javascript'>alert('$message');</script>";
 
    //header("refresh:0;url=login.php");
   

}
}

}

}
?>

</form>

</div>
</body>
</html>