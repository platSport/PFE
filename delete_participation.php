<?php
// Establish database connection
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

// Check if ID is provided in the request
if (isset($_POST['eventId'])) {
    // Escape the ID to prevent SQL injection
    $eventId = mysqli_real_escape_string($conn, $_POST['eventId']);

    // Delete entry from the database based on ID
    $sql = "DELETE FROM participation WHERE id='$eventId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "Entry deleted successfully";
        } else {
            echo "No matching entry found with the provided ID: $eventId";
        }
    } else {
        echo "Error deleting entry: " . mysqli_error($conn);
    }
} else {
    // If event ID is not provided, show an error message
    echo "Error: Event ID not provided.";
}

// Close the connection
mysqli_close($conn);
?>
