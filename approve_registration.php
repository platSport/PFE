<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Retrieve coach's email address from the database based on the approved registration ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Establish connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd3";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the 'approved' field to 1 for the corresponding registration ID
    $updateQuery = "UPDATE userss1 SET approved = 1 WHERE id = $id";

    if (mysqli_query($con, $updateQuery)) {
        // Redirect back to the admin panel after approval
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    // Retrieve coach's email address
    $sql = "SELECT email FROM userss1 WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error retrieving coach's email: " . mysqli_error($con));
    }

    // Fetch the coach's email
    $row = mysqli_fetch_assoc($result);
    $coachEmail = $row['email'];

    // Close the database connection
    mysqli_close($con);
    echo "Coach's Email: " . $coachEmail;

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();                                // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
    $mail->Username   = 'licence005@gmail.com';     // SMTP email
    $mail->Password   = 'ompfpldhcjbkntox';        // SMTP password
    $mail->SMTPSecure = 'ssl';                      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    $mail->setFrom('licence005@gmail.com', 'Your Name'); // Sender Email and name
    $mail->addAddress($coachEmail);                       // Add coach's email
    $mail->addReplyTo('licence005@gmail.com', 'Your Name'); // Reply to sender email

    // Content
    $mail->isHTML(true);                                    // Set email format to HTML
    $mail->Subject = 'Subject of the email';                // Email subject
    $mail->Body    = 'Body of the email';                   // Email body

    // Send the email
    if ($mail->send()) {
        echo "<script>alert('Email sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $mail->ErrorInfo . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}
?>
