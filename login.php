<?php
include 'session.php';

// Database connection details
$host = 'localhost';
$username = 'root';
$password = 'test';
$database = 'strongpass';

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['UserID'])) {
    $UserID = $_POST['UserID'];

    $sql = "SELECT * FROM user WHERE UserID = '$UserID'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $row = $result->fetch_assoc();
        $_SESSION['UserID'] = $UserID;
        $_SESSION['Admin'] = $row['Admin']; // Store admin status in session
        
        // Redirect based on admin status
        if($_SESSION['Admin'] == 1) {
            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo "Invalid UserID or password";
    }
}

// Close database connection
$conn->close();
?>
