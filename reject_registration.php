<?php
// Establish database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bd3"; 

$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    // Escape the ID to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    // Delete registration from the database
    $sql = "DELETE FROM userss1 WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Redirect back to the admin panel
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    // If ID is not provided, show an error message
    echo "Error: ID not provided.";
}
?>
