<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login.php');
    exit;
}

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "municipality";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['project_no'])) {
    $project_no = $_GET['project_no'];

    $sql = "SELECT * FROM addProject WHERE Project_No = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $project_no);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $project = $result->fetch_assoc();
        } else {
            echo "No record found.";
            exit;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_no = $_POST['project_no'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $budget = $_POST['budget'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Debugging: Log the received values
    error_log("Received values - Project No: $project_no, Name: $name, Department: $department, Budget: $budget, Company: $company, Location: $location, Start: $start, End: $end");

    $sql = "UPDATE addProject SET Project_Name = ?, Department_No = ?, Budget = ?, Project_Company = ?, Project_Location = ?, Start_Date = ?, End_Date = ? WHERE Project_No = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sidsissi", $name, $department, $budget, $company, $location, $start, $end, $project_no);
        if ($stmt->execute()) {
            header('location: ProjectDetails.php');
            exit;
        } else {
            echo "Error updating record.";
        }
        $stmt->close();
    } else {
        echo "Error preparing statement.";
    }
} else {
    echo "Invalid request.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Project</h2>
    <form method="post" action="edit_project.php">
        <input type="hidden" name="project_no" value="<?php echo htmlspecialchars($project['Project_No']); ?>">
        <label for="name">Project Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($project['Project_Name']); ?>">
        
        <label for="department">Department:</label>
        <input type="number" id="department" name="department" value="<?php echo htmlspecialchars($project['Department_No']); ?>">
        
        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget" value="<?php echo htmlspecialchars($project['Budget']); ?>">
        
        <label for="company">Project Company:</label>
        <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($project['Project_Company']); ?>">
        
        <!-- <label for="location">Project Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($project['Project_Location']); ?>"> -->
        
        <label for="start">Start Date:</label>
        <input type="date" id="start" name="start" value="<?php echo htmlspecialchars($project['Start_Date']); ?>">
        
        <label for="end">End Date:</label>
        <input type="date" id="end" name="end" value="<?php echo htmlspecialchars($project['End_Date']); ?>">
        
        <input type="submit" value="Update">
        <button class="back-button" onclick="goBack()">Back</button>
    </form>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
