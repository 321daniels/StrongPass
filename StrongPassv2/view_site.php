<!DOCTYPE html>
<html lang="en">
<head>
<title>Strongpass</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href=".\css\view_site.css"/>
</head>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar">
  <br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>StrongPass<br></b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#showcase" onclick="window.location.href='index.html'" class="w3-bar-item w3-button w3-hover-white">Home</a>
    <a href="#showcase" onclick="window.location.href='view_pass.php'" class="w3-bar-item w3-button w3-hover-white">Password</a>
    <a href="#showcase" onclick="window.location.href='support.html'" class="w3-bar-item w3-button w3-hover-white">Support</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-blue w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-blue w3-margin-right" onclick="w3_open()">☰</a>
  <span>Strongpass</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
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

// Construct and execute SQL query using prepared statement
$sql = "SELECT * FROM main WHERE MainID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $siteId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();

  // Calculate number of days since last update
  $lastUpdated = strtotime($row["LastUpdated"]); //converts the last updated time to a Unix timestamp
  $today = time(); // current Unix timestamp
  // Take the difference between the current date and last updated timestamp, and divide by the number of seconds in a day
  $daysSinceUpdate = floor(($today - $lastUpdated) / (60 * 60 * 24));

// Display site information
echo "<div class='centered-text'>";
echo "<div class='site-info-container'>";
echo "<h1>" . htmlspecialchars($row["Site"]) . "</h1>";
echo "<div class='site-info'>";
echo "<p><strong>Username:</strong> " . htmlspecialchars($row["Username"]) . "</p>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($row["Password"]) . "</p>"; // Mask password for security
echo "<p><strong>Last Updated:</strong> " . htmlspecialchars($row["LastUpdated"]) . "</p>";
echo "<p><strong>Note:</strong> " . htmlspecialchars($row["Note"]) . "</p>";
echo "</div>";
echo "</div>";
echo "</div>";

  // If no updates have been made in 15 days, alert the user.
    // NEEDS CSS FORMATTING
    if ($daysSinceUpdate >= 15) {
      echo '<div style="text-align: center;"><div class="update-warning">Warning! Password last updated ' . $daysSinceUpdate . ' days ago.</div></div>';
    }

  // Add buttons section
  echo "<div class='centered-buttons'>";
  echo "<button type='button' onclick='copyUsername(\"" . htmlspecialchars($row["Username"]) . "\")'>Copy Username</button>";
  echo "<button type='button' onclick='copyPassword(\"" . htmlspecialchars($row["Password"]) . "\")'>Copy Password</button>";
  echo "<button type='button' onclick='evalPasswordStrength(\"" . htmlspecialchars($row["Password"]) . "\")'>Password Strength</button>";
  echo "<a href='edit_site.php?id=" . $row["MainID"] . "'><button type='button'>Edit</button></a>";
  echo "<a href='" . htmlspecialchars($row["URL"]) . "' target='_blank'><button type='button'>Visit Site</button></a>";
  echo "</div>";
} else {
  echo "<p class='centered-text'>Site not found!</p>";
}

// Close prepared statement
$stmt->close();

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

    function evalPasswordStrength(password) {
      let score = 0;

      // Checks length requirements
      if (password.length >= 12) {
        score += 2;
      } else if (password.length >= 8) {
        score += 1;
      }

      // Checks character requirements
      const hasUpper = /[A-Z]/.test(password);
      const hasLower = /[a-z]/.test(password);
      const hasNums = /[0-9]/.test(password);
      const hasSpecial = /[^a-zA-Z0-9]/.test(password);

      if (hasUpper && hasLower && hasNums && hasSpecial) {
        score += 2;
      } else if (hasUpper + hasLower + hasNums + hasSpecial >= 2) {
        score += 1;
      }

      // Alert dialog containing strength measurement
      if (score < 2) {
        alert("Password strength: WEAK");
      } else if (score < 4) {
        alert("Password strength: MEDIUM");
      } else if (score === 4) {
        alert("Password strength: STRONG");
      }
    }
    function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var button = event.target;
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    button.textContent = "Hide";
  } else {
    passwordField.type = "password";
    button.textContent = "Show";
  }
}
    </script>

  </div>
</div>

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
