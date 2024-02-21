<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StrongPass</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <style>
        body {
            background-color: lightgray;
        }
        .passwordLayout {
            text-align: center;
            padding-top: 50px; /* Adjust as needed */
        }
        #searchForm {
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adjust as needed */
        }
        #searchInput, button {
			margin: 0; /* Reset margin */
		}
        .centered-buttons {
            text-align: center;
            margin-top: 20px; /* Adjust as needed */
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">StrongPass</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_pass.php">Passwords</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support.html">Support</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="passwordLayout">
    <h1>Passwords</h1>
</section>

<!-- PHP Search Form -->
<form id="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="search" id="searchInput" placeholder="Search for a website...">
    <button type="submit">Search</button>
</form>

<!-- PHP Search Results -->
<?php
// Step 1: Establish a connection to MySQL database
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "test"; // Your MySQL username
$password = "test"; // Your MySQL password
$database = "strongpass"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve search term
    $search = $_POST['search'];

    // Step 4: Construct and execute SQL query
    $sql = "SELECT * FROM main WHERE Site LIKE '%$search%'";
    $result = $conn->query($sql);

    // Step 5: Display search results
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Site</th><th>UserName</th><th>Password</th><th>LastUpdated</th><th>Note</th><th>URL</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Site"]. "</td><td>" . $row["Username"]. "</td><td>" . $row["Password"]. "</td><td>" . $row["LastUpdated"]. "</td><td>" . $row["Note"]. "</td><td>" . $row["URL"]. "</td></tr>";
            // You can display other columns as needed
        }
        echo "</table>";
    } else {
        echo "<p>No results found</p>";
    }
}
?>

</body>
</html>
