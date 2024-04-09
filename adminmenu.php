<!DOCTYPE html>
<html lang="en">
<head>
<title>Strongpass</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="./css/edit_site.css"/>
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
    <a href="#showcase" onclick="window.location.href='index.php'" class="w3-bar-item w3-button w3-hover-white">Home</a>
    <a href="#showcase" onclick="window.location.href='view_pass.php'" class="w3-bar-item w3-button w3-hover-white">Password</a>
    <a href="#showcase" onclick="window.location.href='support.php'" class="w3-bar-item w3-button w3-hover-white">Support</a>
    </br>
    </br>
    </br>
    </br>
    <form action="logout.php" method="post">
      <button type="submit" class="w3-bar-item w3-button w3-hover-white">Admin Logout</button>
    </form>
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
    <!-- Admin Settings -->
    <?php
      // Check if the user is logged in
      include 'session.php';
      if(!isset($_SESSION['UserID']) || !isAdmin()) {
        header("Location: login.php");
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
          echo '<div class="alert2 alert-success" role="alert">Settings saved successfully!</div>';
        } else {
          echo '<div class="alert alert-success" role="alert">Error updating settings!</div>';
          echo "Error updating settings: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
      }

      mysqli_close($conn);
    ?>
        <h1>Admin Settings</h1>
        <br></br>
        <h3>Password Alert Settings</h3>
        <form method="post">
          <label for="reminder_days">Password Age Reminder (in Days):</label>
          <input type="number" id="reminder_days" name="reminder_days" min="1" value="<?php echo $reminderDays; ?>">
          <br></br>
          <label for="min_length">Minimum Password Length:</label>
          <input type="number" id="min_length" name="min_length" min="1" value="<?php echo $minLength; ?>">
            <div class="centered-buttons">
            <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
      <br>
 
<!-- Form for managing users -->
<div class="centered-buttons">
    <h3>User Managment</h3>
      <button type="button" onclick="window.location.href='manage_user.php'" class="btn btn-primary">Manage Users</button>
    </form>
</div>

<script>
  // Script to open and close sidebar
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
