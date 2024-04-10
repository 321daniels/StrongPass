<?php
include 'session.php';

// Check if the user is logged in
if(!isset($_SESSION['UserID'])) {
    header("Location: login_page.html");
    exit();
}
$Admin=isAdmin();
$UserID = getUserID();

$servername = "localhost";
$username = "root";
$password = "test";
$dbname = "strongpass";

// Establish MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from MySQL table
$sql = "SELECT * FROM main";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// File name for the CSV file
$filename = "output.csv";

// Header for CSV file
$header = "MainID,UserID,Site,Username,Password,LastUpdated,Note,URL,VIewerID,Category\n";

// Data for CSV file
$data = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Assuming no special characters in the fields
        $data .= $row['MainID'] . "," . $row['UserID'] . "," . $row['Site'] . "," . $row['Username'] . "," . $row['Password'] . "," . $row['LastUpdated'] . "," . $row['Note'] . "," . $row['URL'] . "," . $row['VIewerID'] ."," . $row['Category'] . "\n";
    }
}

// Close MySQL connection
$conn->close();

// Output CSV as downloadable file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Output CSV data
echo $header . $data;
?>
