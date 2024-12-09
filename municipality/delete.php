<?php
// Check if citizenID parameter is set and not empty
if (isset($_GET['citizenID']) && !empty($_GET['citizenID'])) {
    // Retrieve citizenID from GET parameters
    $citizenID = $_GET['citizenID'];

    // Database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "municipality";
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare a delete statement
    $sql = "DELETE FROM citizen_details WHERE Citizen_ID = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_citizenID);

        // Set parameters
        $param_citizenID = $citizenID;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Close statement
            mysqli_stmt_close($stmt);

            // Close connection
            mysqli_close($conn);

            // JavaScript alert for successful deletion
            echo '<script>alert("The details have been deleted successfully.");</script>';
            // Redirect to viewdetails.php after alert
            echo '<script>window.location.href = "viewdetails.php";</script>';
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // citizenID parameter is not set or empty. Redirect to index page
    header("location: index.php");
    exit();
}
?>
