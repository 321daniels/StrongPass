<?php
$servername = "localhost";
$username = "test";
$password = "test";
$dbname = "strongpass";

// Establish MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truncate the existing table
$sql_truncate = "TRUNCATE TABLE main";
if ($conn->query($sql_truncate) === FALSE) {
    echo "Error truncating table: " . $conn->error;
}

// Check if a file was uploaded
if(isset($_FILES["fileToUpload"])) {
    $file = $_FILES["fileToUpload"];
    
    // Check if there was no error during file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Move uploaded file to desired directory
        $destination = 'C:/wamp64/tmp/' . $file['name']; // Destination path
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Query to import data from CSV into MySQL table
            $sql = "LOAD DATA INFILE '$destination' INTO TABLE main 
                    FIELDS TERMINATED BY ',' 
                    LINES TERMINATED BY '\n' 
                    IGNORE 1 LINES 
                    (MainID, UserID, Site, Username, Password, LastUpdated, Note, URL, VIewerID)";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "CSV file imported successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error moving file to destination.";
        }
    } else {
        echo "Error uploading file.";
    }
}

// Close MySQL connection
$conn->close();
?>
