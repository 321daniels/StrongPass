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
    <?php
    include 'session.php';

    // Check if the user is logged in
    if (!isset($_SESSION['UserID'])) {
        header("Location: login.php");
        exit();
    }

    // Check if the user is an admin
    if (!isAdmin()) {
        header("Location: index.php");
        exit();
    }

    // Check if UserID is provided in the URL
    if (!isset($_GET['UserID'])) {
        header("Location: adminmenu.php");
        exit();
    }

    $UserID = $_GET['UserID'];

    // Delete the user from the database
    $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
    $username = "root"; // MySQL username
    $password = "test"; // MySQL password
    $database = "strongpass"; // MySQL database name
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_delete = "DELETE FROM user WHERE UserID = $UserID";

    if ($conn->query($sql_delete) === TRUE) {
        echo '<div class="alert alert-danger" role="alert">User deleted successfully!';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error . ' . $conn->error . '</div>';
    }

    $conn->close();
    ?>
</div>

<div class="centered-buttons">
    <button type="button" onclick="window.location.href='manage_user.php'" class="btn btn-primary">Back to Manage Users</button>
</div>



</body>
</html>
