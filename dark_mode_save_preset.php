<?php
// Get data from POST request
$presetName = $_POST['presetName'];
$presetColor = $_POST['presetColor'];

// Database connection
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // MySQL username
$password = "test"; // MySQL password
$database = "strongpass"; // MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
$sql = "INSERT INTO presets (name, color) VALUES ('$presetName', '$presetColor')";
if ($conn->query($sql) === TRUE) {
    echo "Preset saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
