<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bd3"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Create table for coaches
$sql_create_coaches_table = "CREATE TABLE IF NOT EXISTS coaches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    age INT NOT NULL UNIQUE,
    email VARCHAR(20) NOT NULL
)";
if ($conn->query($sql_create_coaches_table) === TRUE) {
    echo "Coaches table created successfully";
} else {
    echo "Error creating coaches table: " . $conn->error;
}

// Create table for events
$sql_create_events_table = "CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    details TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
)";
if ($conn->query($sql_create_events_table) === TRUE) {
    echo "Events table created successfully";
} else {
    echo "Error creating events table: " . $conn->error;
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission to add coaches
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCoach'])) {
    // Escape user inputs for security
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $age = $conn->real_escape_string($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);

    // Insert into database
    $sql = "INSERT INTO coaches (first_name, last_name, age, email) VALUES ('$first_name', '$last_name', '$age', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Coach added successfully";
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
    <title>Add Coach</title>
    <link rel="stylesheet" href="admin.css">
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* Center the form within the background */
                /* Center the form within the background */
.background {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
   
    
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

 /* Table Styles */
 h3 {
            /*text-align: center;*/
            margin-bottom: 60px;
            color:  #861a1a;
            margin-left: 5%;
        }
.card-menu-items p {
    margin: 0; /* Supprimer les marges par défaut du paragraphe */
    font-size: 14px; /* Taille de la police */
}
.card-menu-items:hover {
    background-color: #861a1a; /* Darkened color on hover */
}
        /* Style for the form */
        #coach-form {
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
    margin-left: 25%;
        }

        #coach-form h3 {
            margin-bottom: 40px;
            color:  #861a1a;
            margin-left: 5%;
        }

        #coach-form input,
        #coach-form textarea,
        #coach-form button {
            width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #b20b0b;
    border-radius: 5px;
    box-sizing: border-box;
        }

        #coach-form button {
            background-color: #b20b0b;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            padding: 10px;
        }

        #coach-form button:hover {
            background-color: #861a1a;
        }

        /* Table Styles */
        h3 {
            margin-left: 25%;
            
            margin-bottom: 60px;
            color:  #861a1a;
        }
        
        table {
            width: 70%;
            margin-left: 20%;
            border-collapse: collapse;
            overflow-y: auto; /* Activer le défilement vertical si nécessaire */
            border-right: 1px solid #ccc; /* Bordure droite */
            z-index: 100;
            overflow-y: auto; /* Activer le défilement vertical si nécessaire */
            overflow-X: auto;
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
        
        .action-links {
            display: flex;
            justify-content: flex-end; /* Aligner les liens à droite */
            margin-top: 10px; /* Ajouter un espacement en haut des liens */
        }
        
        .action-links a {
            padding: 8px 16px; /* Augmenter l'espacement des liens */
            margin-left: 10px; /* Ajouter un espacement entre les liens */
            border: 1px solid #007bff;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
        }
        
        .action-links a:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>
    <div class="background">
        <div class="content">
            <div id="coach-form">
                <h3>Add Coach</h3>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="first_name" placeholder="First Name" required><br>
                    <input type="text" name="last_name" placeholder="Last Name" required><br>
                    <input type="number" name="age" placeholder="Age" required><br>
                    <input type="email" name="email" placeholder="Email" required><br>
                    <button type="submit" name="addCoach">Add</button>
                </form>
            </div>
        </div>
    </div>

    <div id="coach-table">
        <h3>Coaches</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
            <?php
            // PHP code to fetch coaches from the database
            $sql = "SELECT id, first_name, last_name, age, email FROM coaches";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["first_name"] . "</td>
                            <td>" . $row["last_name"] . "</td>
                            <td>" . $row["age"] . "</td>
                            <td>" . $row["email"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 coaches</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
