<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styledash.css">
    <link rel="stylesheet" href="styledash.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/Paint.png" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Present Events</title>
    <style>
        /* CSS for present events */
        .event-event{
            width: 80%;
            margin-left:15%;
        }
        .event {
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f9f9f9;
    display: inline-block; /* Set display to inline-block */
    margin-right: 20px; /* Add some margin between events */
    
}


        .event h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #27374d;
            margin-left:23%;
        }

        .event p {
            margin: 0;
            color: black;
            margin-bottom: 10px;
        }

        .event-details {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .event-details strong {
            font-weight: bold;
            color: #555;
        }

        .event-details p {
            margin: 30px 10px;
            border: 20px;
        
        }
        .event button {
    background-color: #27374d;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 5px 15px;
    margin-bottom: 10px;
    margin-right: 15px;
    cursor: pointer;
}

.event button:hover {
    background-color: #dde6ed;
    color:black;
}
    </style>
</head>
<body>
<div class="container">
    <nav>
    <div class="nav-left">
           
         
           <?php
include("bd2.php");

// Requête SQL pour sélectionner tous les utilisateurs
$query = "SELECT * FROM userss1";

$result = mysqli_query($con, $query);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
   // Déplacer le pointeur de résultat vers la dernière ligne
   mysqli_data_seek($result, mysqli_num_rows($result) - 1);
   
   // Récupérer les données de la dernière ligne
   $row = mysqli_fetch_assoc($result);

   // Afficher l'image de l'utilisateur
   echo '<img src="' . $row['picture'] . '" alt="Profile Picture">';
   // Afficher le nom du superviseur
   echo "<p>" . $row['supervisor'] . "</p>";

} else {
   // Si aucun utilisateur n'est trouvé, afficher un message
   echo "<p>Non connecté</p>";
}
?>
      
           </div>

            <div class="nav-centre">  
                <div class="search-box">
                    <i class="fas fa-search"></i>



                    <input type="text" placeholder="Rechercher par nom d'utilisateur" oninput="searchByUsername(event)"> 
                </div>
            </div>
            <div class="nav-right">
            <a href="#" class="img"  onclick="exportToExcel()">
                <i class="fas fa-arrow-down"></i>
               <a>

                <img src="images/align-justify-solid.svg" alt="" class="profile-pic" onclick="openCard()">
                
                <div class="card-menu-wrap" id="cardwrap">
                    <div class="card-menu">
                        
                        <a href="#" class="card-menu-items" onclick="logout()">
                            <img src="images/sign-out-alt-solid.svg" alt="">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </nav>
        <div class="main">
            <div class="main-left">
                <a href="dash.php" class="img"onclick="home()">
                <i class="fa-solid fa-house"></i>
                    <p>Home</p>
                </a>
                <a href="joueur.php" class="img" onclick="ajouter()">
                    <i class="fa-solid fa-user-plus"></i>
                    <p>Add Event</p>
                </a>

                <a href="#" class="img" onclick="">
                     <i class="fas fa-chart-line"></i>
                    <p>Statistical</p>
                </a>
                <a href="   Events.php" class="img" onclick="">
                     <i class="fas fa-chart-line"></i>
                    <p>Events</p>
                </a>
                
                <a href="#" class="img-out" onclick="logout()">
                       <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                </a>
                
               

            </div> 

</div>
<div class="event-event">
<?php
// Start the session removed from here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd3";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$queryy = "CREATE TABLE IF NOT EXISTS participation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_name VARCHAR(255) NOT NULL,
    event_title VARCHAR(255) NOT NULL,
    approved TINYINT NOT NULL DEFAULT 0
)";

mysqli_query($conn, $queryy); // Fix the variable name here

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Output the session variable for debugging purposes
$clubName = isset($_SESSION['club_name']) ? $_SESSION['club_name'] : "Club Name not set";

$query = "SELECT * FROM events ";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any results
if ($result && mysqli_num_rows($result) > 0) {
    // Loop through each row and display event information
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='event'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p><strong>Details:</strong> " . $row["details"] . "</p>";
        echo "<p><strong>Start Date:</strong> " . $row["start_date"] . "</p>";
        echo "<p><strong>End Date:</strong> " . $row["end_date"] . "</p>";
        echo "<button onclick='participate(" . $row["id"] . ")'>Participate</button>"; // Add participate button
        echo "<button onclick='approve(" . $row["id"] . ")'>Approve</button>"; // Add approve button
        echo "</div>";
    }
} else {
    echo "No events found.";
}

// Close the database connection
mysqli_close($conn);
?>
 </div>   
<script>
function participate(eventId) {
    // Send an AJAX request to add_participation.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "add_participation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("eventId=" + eventId);
}

function approve(participationId) {
    // Send an AJAX request to approve_participation.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "approve_participation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("participationId=" + participationId);
}

function deleteEvent(eventId) {
    // Send an AJAX request to delete_event.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            // Reload the page after deletion
            location.reload();
        }
    };
    xhttp.open("POST", "delete_event.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("eventId=" + eventId);
}
</script>

</body>
</html>
