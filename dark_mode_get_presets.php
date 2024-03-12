<?php
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

// Retrieve presets from the database
$sql = "SELECT * FROM presets";
$result = $conn->query($sql);

$presets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $presets[] = $row;
    }
}

echo json_encode($presets);

$conn->close();
?>
