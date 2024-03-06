<!-- Edit a saved entry -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>StrongPass - Edit Site</title>
  <link rel="stylesheet" href=".\css\site_view.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
</head>

<body style="background-color: lightgray">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="./Index.html">StrongPass</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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

  <?php
  // Establish connection
<<<<<<< Updated upstream
  $servername = "localhost";
  $username = "test";
  $password = "test";
  $database = "strongpass";
=======
    $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
    $username = "test"; // MySQL username
    $password = "test"; // MySQL password
    $database = "strongpass"; // MySQL database name
>>>>>>> Stashed changes

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

  // Check if form is submitted ("edit" button clicked)
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $newUsername = htmlspecialchars($_POST['username']);
    $newPassword = htmlspecialchars($_POST['password']);
    $newNote = htmlspecialchars($_POST['note']);
    // Include an updated timestamp when user submits change
    $currentTime = date("Y-m-d H:i:s");
    // This was a secure way to sanitize data but is now deprecated
    // $newUsername = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    // $newPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    // $newNote = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
  
    // Construct and execute update query
    $sql = "UPDATE main SET Username = '$newUsername', Password = '$newPassword', Note = '$newNote', LastUpdated = '$currentTime' WHERE MainID = $siteId";
    $result = $conn->query($sql);

    // Display to user if update was successful
    if ($result) {
      echo '<div class="alert alert-success" role="alert">Entry updated successfully!</div>';
    } else {
      echo '<div class="alert alert-danger" role="alert">Error updating password. ' . $conn->error . '</div>';
    }
  }

  // Retrieve site information for display
  $sql = "SELECT * FROM main WHERE MainID = $siteId";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Display form to edit site information
    echo "<h1>Edit Site Information</h1>";
    echo "<form method='post'>";
    echo "<div class='form-group'>";
    echo "<label for='username'>Username:</label>";
    echo "<input type='text' class='form-control' id='username' name='username' value='" . $row["Username"] . "'>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' class='form-control' id='password' name='password' value='" . $row["Password"] . "'>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='note'>Note:</label>";
    echo "<textarea class='form-control' id='note' name='note' rows='3'>" . $row["Note"] . "</textarea>";
    echo "</div>";
    echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
    echo "</form>";
  } else {
    echo "<p>Site not found!</p>";
  }

  // Close connection
  $conn->close();