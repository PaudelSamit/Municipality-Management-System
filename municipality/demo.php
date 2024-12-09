<!DOCTYPE html>
<html>
    <head>
   <style>
  
   </style>


    </head>
    <body>
    <form action="?" method="post">
    <input type="submit" name="submit" value="Submit"><br>

       <?php
          $server="localhost";
          $username="root";
          $password="";
          $database_name="municipality";

          $conn=mysqli_connect($server,$username,$password,$database_name);

          if(!$conn){
            echo "Connection failed: ".mysqli_connect_error();
          }
        

           if(isset($_POST['submit'])){
                   

            $sql="select * from emp_register where emp_username='Gautam02'";

            function view($conn, $sql, $row)
            {

                if($query = mysqli_query($conn, $sql))
                {
                    if(mysqli_num_rows($query) > 0)
                    {
                        while($result = mysqli_fetch_array($query)){
                            $uname  = $result['emp_username'];
                            $psw = $result['emp_password'];
        
                            $row = $row."<tr>
                                <td>$uname</td>
                                <td>$psw</td>
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
              <th>User Name</th>
              <th>Password</th>
            </tr>".$s."
            </table>";

            mysqli_close($conn);
          
        }
       ?>
    </form>
   

    </body>

</html>