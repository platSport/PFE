<!-- admin_panel.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_styles.css">
    <title>Admin Panel</title>
    
</head>
<body>
    <h1>Admin Panel</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Club Name</th>
                <th>Event Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
            
            $sql = "SELECT * FROM participation WHERE approved = 0";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['club_name'] . "</td>";
                    echo "<td>" . $row['event_title'] . "</td>";
                    echo "<td>";
                    echo "<button onclick='approve(" . $row['id'] . ")'>Approve</button>";
                    echo "<button onclick='deleteEntry(" . $row['id'] . ")'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No unapproved entries found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
    function approve(participationId) {
        // Send AJAX request to approve_participation.php with the participation ID and action
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Refresh the page or update the table dynamically after approval
                location.reload();
            }
        };
        xhttp.open("POST", "approve_participation.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("participationId=" + participationId);
    }

  
function deleteEntry(eventId) {
    // Send AJAX request to delete_participation.php with the event ID
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            // Refresh the page or update the table dynamically after deletion
            location.reload();
        }
    };
    xhttp.open("POST", "delete_participation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("eventId=" + encodeURIComponent(eventId)); // Pass the event ID
}


    </script>
</body>
</html>
