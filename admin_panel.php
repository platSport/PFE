<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bd3"; 

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve pending registrations
$sql = "SELECT * FROM userss1 WHERE approved = 0";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error retrieving pending registrations: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_styles.css">
    <!-- Add any necessary stylesheets or scripts -->
</head>
<body>
    <h1>Pending Registrations</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Club Name</th>
            <th>Supervisor</th>
            <!-- Add more table headers for other fields as needed -->
            <th>Action</th>
        </tr>
        <?php
        // Display pending registrations in a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['clubname'] . "</td>";
            echo "<td>" . ($row['supervisor'] ? 'Yes' : 'No') . "</td>";
            // Add more table cells for other fields as needed
            echo "<td><a href='approve_registration.php?id=" . $row['id'] . "'>Approve</a> | <a href='reject_registration.php?id=" . $row['id'] . "'>Reject</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
