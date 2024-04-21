// approve_participation.php

<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd3";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the participation ID is received via POST
if(isset($_POST['participationId'])) {
    $participationId = $_POST['participationId'];
    
    // Update the 'approved' field to 1 for the corresponding participation ID
    $updateQuery = "UPDATE participation SET approved = 1 WHERE id = $participationId";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Event approved successfully";
    } else {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Participation ID not received";
}

// Close the database connection
mysqli_close($conn);
?>
