<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bd3"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission to add events
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $title = $conn->real_escape_string($_POST['eventTitle']);
    $details = $conn->real_escape_string($_POST['eventDetails']);
    $start_date = $conn->real_escape_string($_POST['eventStartDate']);
    $end_date = $conn->real_escape_string($_POST['eventEndDate']);

    // Insert into database
    $sql = "INSERT INTO events (title, details, start_date, end_date) VALUES ('$title', '$details', '$start_date', '$end_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Event added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed; /* Fixed position for the sidebar */
            top: 0;
            left: 0;
            background-color: hsl(0, 88%, 37%);
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: white;
            margin-bottom: 20px; /* Added margin to separate header from buttons */
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu button {
            margin-bottom: 10px;
            padding: 10px;
            width: 80%;
            background-color: #b20b0b;
            border: none;
            cursor: pointer;
            color: white;
            display: block;
            text-align: center;
            border-radius: 5px; /* Added border radius for button */
        }

        .sidebar-menu button:hover {
            background-color: #861a1a; /* Darkened color on hover */
        }
        .card-menu {
    position: absolute; /* Position absolue par rapport au conteneur parent */
    bottom: 20px; /* Espacement par rapport au bas de la barre latérale */
    left: 0; /* Alignement à gauche */
    right: 0; /* Alignement à droite */
    text-align: center; /* Centrer horizontalement */
}

.card-menu-items {
    margin-bottom: 10px;
            padding: 10px;
            width: 80%;
            background-color: #b20b0b;
            border: none;
            cursor: pointer;
            color: white;
            display: block;
            text-align: center;
            border-radius: 5px;
}


.card-menu-items p {
    margin: 0; /* Supprimer les marges par défaut du paragraphe */
    font-size: 14px; /* Taille de la police */
}
.card-menu-items:hover {
    background-color: #861a1a; /* Darkened color on hover */
}



        /* Modal Styles 
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 5px; /* Added border radius for modal 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
*/
        .content {
            position: absolute;
            left: 50px; /* Adjusted to match the width of the sidebar*/ 
            width: calc(100% - 250px); /* Adjusted to match the width of the sidebar */
            padding: 20px; /* Adjusted for spacing */
            box-sizing: border-box; /* Ensure padding is included in width calculation */
        }

        /* Table Styles */
        h3 {
            /*text-align: center;*/
            margin-bottom: 60px;
            color:  #861a1a;
            margin-left: 30%;
        }
        
        table {
            width: 70%;
            margin-left: 20%;
            border-collapse: collapse;
            overflow-y: auto; /* Activer le défilement vertical si nécessaire */
            border-right: 1px solid #ccc; /* Bordure droite */
            z-index: 100;
        }
        
         td {
            padding: 8px;
            border: 2px solid #861a1a;
            text-align:  3% left;
            color: black;
           
        }
        
        th {
            background-color: #f2f2f2;
            padding: 8px;
            border: 2px solid #861a1a;
            text-align:  3% left;
            color:  #861a1a;
            
           
           
        }
        
        tr , td {
            background-color: #f2f2f2;
           
            border: 2px solid #861a1a;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f2f2f2;
        }
        
        a {
            color: #007bff;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        
        /* Style for delete button */
        .delete-button {
            background-color: #ff0000; /* Red background */
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #cc0000; /* Darker red on hover */
        }
        .delete-button a{
            background-color: #ff0000; /* Red background */
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
        }
        /* Center the form within the background */
.background {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
}

/* Style for the form */
/* Center the event form within the background */
#event-form {
   
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
    border-radius: 5px;
    width: 50%; /* Adjust width as needed */
    max-width: 500px; /* Maximum width for the form */
    margin: auto; /* Center horizontally */
    margin-top: 50px; /* Adjust vertical margin as needed */
    margin-bottom: 50px;
}

#event-form h3 {
         margin-bottom: 40px;
            color:  #861a1a;
            margin-left: 5%;
}
#event-form input[type="text"],
#event-form textarea,
#event-form input[type="datetime-local"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #b20b0b;
    border-radius: 5px;
    box-sizing: border-box;
}

#event-form button {
    background-color: #b20b0b;
    color: white;
    width: 100%;
    border: 1px solid #b20b0b;
    padding: 10px;
}

#event-form button:hover {
    background-color: #861a1a;
}

    </style>
</head>
<body>
<div class="sidebar">
    <h2>DashBoard</h2>
    <div class="sidebar-menu">
    <button onclick="displayWelcome()">Home</button>
    <button onclick="displayEvents()">Add Event</button>
    <a href="coach.php"><button>Add Coach</button></a> 
    <a href="admin_panel.php"><button>Admin Panel Registration</button></a>
    <a href="eventpanel.php"><button>Admin Panel Participation</button></a>
</div>

</div>

<div class="background">
    <div class="content" id="main-content">
        <div id="welcome-message" style="display:none;">
            <h3>WELCOME!</h3>
        </div>
    </div>
    <div class="content" id="events-content" style="display:none;">
        
        <div id="event-form">
            <h3>Add Event</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="eventTitle" placeholder="Title" required><br>
                <textarea name="eventDetails" placeholder="Details" required></textarea><br>
                <input type="datetime-local" name="eventStartDate" required><br>
                <input type="datetime-local" name="eventEndDate" required><br>
                <button type="submit">Add</button>
            </form>
        </div>
        <div id="events-table">
            <h3>Events</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th> 
                </tr>
                <?php
                
                $sql = "SELECT id, title, details, start_date, end_date FROM events";
                $result = $conn->query($sql);
                if (!$result) {
                 die("Error: " . $conn->error);
                 }
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["details"] . "</td>
                            <td>" . $row["start_date"] . "</td>
                            <td>" . $row["end_date"] . "</td>
                            <td><a class='delete-button' href='deleteEvent.php?ID=".$row['id']."' id='btn'>delete</a> <!-- Add delete button -->
                            <button class='delete-button'><a href='player-edit-admine.php?id=".$row['id']."' id='btn'>update </a> </button></td> 
                           
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 results</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="toggleAddEventForm()">&times;</span>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Form to submit event data to PHP -->
            <input type="text" name="eventTitle" placeholder="Title" required><br>
            <textarea name="eventDetails" placeholder="Details" required></textarea><br>
            <input type="datetime-local" name="eventStartDate" required><br>
            <input type="datetime-local" name="eventEndDate" required><br>
            <button type="submit">Add</button>
        </form>
    </div>
</div>

<script>
    function displayWelcome() {
        document.getElementById("main-content").style.display = "block";
        document.getElementById("events-content").style.display = "none";
        document.getElementById("welcome-message").style.display = "block";
    }

    function displayEvents() {
        document.getElementById("main-content").style.display = "none";
        document.getElementById("events-content").style.display = "block";
    }

    function toggleAddEventForm() {
        var modal = document.getElementById('modal');
        if (modal.style.display === 'none' || modal.style.display === '') {
            modal.style.display = 'block';
        } else {
            modal.style.display = 'none';
        }
    }

    function deleteEvent(id) {
        if (confirm("Are you sure you want to delete this event?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //alert(this.responseText);
                    location.reload(); // Reload the page after deletion
                }
            };
            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("deleteEvent=" + id);
        }
    }
</script>
</body>
</html>
