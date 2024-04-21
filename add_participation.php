<?php
session_start(); // Start the session

// Check if the event ID is received via POST
if(isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];
    $clubName = isset($_SESSION['club_name']) ? $_SESSION['club_name'] : "Club Name not set";
    
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

    // Retrieve the event title based on the event ID
    $query = "SELECT title FROM events WHERE id = $eventId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $eventTitle = $row['title'];

        // Insert participation details into the participation table
        $insertQuery = "INSERT INTO participation (club_name, event_title) VALUES ('$clubName', '$eventTitle')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Participation added successfully";
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Event not found with ID: $eventId";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
