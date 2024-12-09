<?php
  session_start();
  if(!empty($_POST["remember"])) {  
    setcookie ("username",$_POST["uname"],time()+ 60*60*24*30,'/');  
    setcookie ("password",$_POST["psw"],time()+ 60*60*24*30,'/');  
  // echo "Cookies Set Successfuly"; 
  } 
  else 
  {  
   setcookie("username","");  
   setcookie("password","");  
   //echo "Cookies Not Set"; 
  } 

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="municipality";
$conn=mysqli_connect($host,$dbusername,$dbpassword,$dbname);


if(!$conn)
{
    echo "Server is not connected";

}



  $name=$_POST['uname'];
  $pass=$_POST['psw'];
$sql="SELECT * from emp_register where emp_username='$name' && emp_password ='$pass' ";

 $result=mysqli_query($conn, $sql);
 $row=mysqli_num_rows($result);
 
     if($row==1)
   {
     $_SESSION["U"]=$name;
     $_SESSION["loggedin"]=true;
     
    //  $message = "LOGIN SUCCESSFUL!!! ";
    //   echo "<script type='text/javascript'>alert('$message');</script>";
    
      header('location:adminpage.php');
       
   
    }
    else{
       
        $message = "LOGIN FAILED DUE TO WRONG CREDENTIALS !!! ";
       echo "<script type='text/javascript'>alert('$message');</script>";
    
      header('location:login.php');
            
        }

        
?>