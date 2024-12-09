<?php
session_start();


$server="localhost";
$username="root";
$password="";
$database_name="municipality";

$conn=mysqli_connect($server,$username,$password,$database_name);

if(!$conn){
   echo "server is not connected!!!";
}

$name=$_POST['uname'];
$password=$_POST['psw'];

$s="select * from emp_register where emp_username='$name' ";

$result=mysqli_query($conn,$s);

$row=mysqli_num_rows($result);

if($row==1){
   ?>
 <script> alert("User Already Exists");</script>
  <?php
    //header('location:register.html');
}


else{


   $sql_query="insert into emp_register (emp_username,emp_password)
                          values('$name','$password')";

                          if(mysqli_query($conn,$sql_query)){
                           header('location:login.php');
                          }
                          else
                          {
                           echo "Error".$sql_query." ".mysqli_error($conn);
                          } 
                         
}


mysqli_close($conn);

?>
