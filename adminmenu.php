<!-- Admin users can enforce requirements for password age and length -->
<?php

include 'session.php';

// Check if the user is logged in
if(!isset($_SESSION['UserID']) || !isAdmin()) {
  header("Location: login.html");
  exit();
}

$Admin=isAdmin();
$UserID = getUserID();


// Establish a connection to MySQL database
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // MySQL username
$password = "test"; // MySQL password
$database = "strongpass"; // MySQL database name


$conn = new mysqli($servername, $username, $password, $database);

// IMPORTANT NOTE: Ensure that PassAge and PassLength have values in the adminset table already, otherwise the update may not work.
// Variables for current/future settings
$reminderDays = "";
$minLength = "";

// Retrieve the current admin settings
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  $sql = "SELECT PassAge, PassLength FROM adminset";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $reminderDays = $row["PassAge"];
    $minLength = $row["PassLength"];
  }
}

// Handle form submission (if submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reminderDays = (int) $_POST['reminder_days'];
  $minLength = (int) $_POST['min_length'];

  // Update query with prepared statement
  $sql = "UPDATE adminset SET PassAge=?, PassLength=?";
  $stmt = mysqli_prepare($conn, $sql);

  // Bind values to prepared statement (prevents SQL injection)
  mysqli_stmt_bind_param($stmt, "ii", $reminderDays, $minLength);

  if (mysqli_stmt_execute($stmt)) {
    echo "Settings saved successfully!";
  } else {
    echo "Error updating settings: " . mysqli_error($conn);
  }
  mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Settings</title>
</head>
<body>
  <h1>Admin Settings</h1>
  <form method="post">
    <label for="reminder_days">Password Age Reminder (in Days):</label>
    <input type="number" id="reminder_days" name="reminder_days" min="1" value="<?php echo $reminderDays; ?>">
    <br><br>
    <label for="min_length">Minimum Password Length:</label>
    <input type="number" id="min_length" name="min_length" min="1" value="<?php echo $minLength; ?>">
    <br><br>
    <button type="submit">Save Settings</button>
  </form>
</body>
</html>