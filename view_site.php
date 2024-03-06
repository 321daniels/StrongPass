<!-- Access saved data for a specific site -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>StrongPass</title>
    <link rel="stylesheet" href=".\css\style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <script src="./darkmode.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<!-- Nav Bar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./Index.html">StrongPass</a>
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation">
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
        <li class="nav-item">
          <a class="nav-link" href=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=""></a>
        </li>
      </ul>
    <!-- Dark Mode Toggle Button -->
    <div class="toggle-container">
    <button id="toggleOptions">🌘⬌☀️</button>
    <div class="options-popout d-none" id="optionsPopout">
    <input type="color" id="customColor" />
      </div>
    </div>
  </div>
</nav>

    <div class="container mt-4">
  <?php
  // Establish connection
    $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
    $username = "root"; // MySQL username
    $password = "test"; // MySQL password
    $database = "strongpass"; // MySQL database name

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve site ID from URL parameter
  $siteId = isset($_GET['id']) ? $_GET['id'] : null;

  // Validate and sanitize site ID
  if (is_numeric($siteId)) {
    $siteId = intval($siteId); // Convert to integer for database query
  } else {
    die("Invalid site ID");
  }

  // Construct and execute SQL query
  $sql = "SELECT * FROM main WHERE MainID = $siteId";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Display site information
    echo "<h1>" . $row["Site"] . "</h1>";
    echo "<table>";
    echo "<tr><td>Username</td><td>" . $row["Username"] . "</td></tr>";
    echo "<tr><td>Password</td><td>" . $row["Password"] . "</td></tr>";
    echo "<tr><td>Last Updated</td><td>" . $row["LastUpdated"] . "</td></tr>";
    echo "<tr><td>Note</td><td>" . $row["Note"] . "</td></tr>";
    echo "</table>";

    // Add buttons section
    echo "<div class='button-container button'>";
    echo "<button type='button' class='centered-buttons2' onclick='copyUsername(\"" . $row["Username"] . "\")'>Copy Username</button>";
    echo "<button type='button' class='centered-buttons2' onclick='copyPassword(\"" . $row["Password"] . "\")'>Copy Password</button>";
    echo "<a href='edit_site.php?id=" . $row["MainID"] . "'><button type='button' class='centered-buttons2'>Edit</button></a>";
    echo "<a href='" . $row["URL"] . "' target='_blank'><button type='button' class='centered-buttons2'>Visit Site</button></a>";
    echo "</div>";
    } else {
        echo "<p>Site not found!</p>";
    }

// Close connection
$conn->close();
  ?>

<script>
      function copyUsername(username) {
        navigator.clipboard.writeText(username);
        alert("Username copied!");
      }

      function copyPassword(password) {
        navigator.clipboard.writeText(password);
        alert("Password copied!");
      }
    </script>


  </body>
</html>

