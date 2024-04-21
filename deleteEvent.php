<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bd3"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['ID'])) {  
    $id = $_GET['ID']; 
   

    $query = "DELETE FROM `events` WHERE ID = '$id'";
   
    
    $run = mysqli_query($conn, $query); // Changed $conn to $con
    if ($run) {  
        header('location:admine.php');  
    } else {  
        echo "Error: " . mysqli_error($conn); // Changed $conn to $con
    }  
}

?>
