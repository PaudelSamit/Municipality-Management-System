<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login.php');
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "municipality";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if(mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
    }

    $project_no = $_POST['project_no'];

    $sql = "DELETE FROM addProject WHERE Project_No = ?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $project_no);
        if($stmt->execute()){
            header("location: ProjectDetails.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
        $stmt->close();
    }
    $conn->close();
} else {
    header("location: ProjectDetails.php");
    exit();
}
?>
