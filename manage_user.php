
<!DOCTYPE html>
<html lang="en">
<head>
<title>Strongpass </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="./css/style.css"/>
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
    <!-- Manage Users -->
    <?php
      // Check if the user is logged in
      include 'session.php';
      if(!isset($_SESSION['UserID']) || !isAdmin()) {
        header("Location: login.php");
        exit();
      }

       // Establish a connection to MySQL database
       $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
       $username = "root"; // MySQL username
       $password = "test"; // MySQL password
       $database = "strongpass"; // MySQL database name
       $conn = new mysqli($servername, $username, $password, $database);

      // Fetch all users
      $sql_fetch_users = "SELECT * FROM `user`";
      $result_users = $conn->query($sql_fetch_users);

      if ($result_users->num_rows > 0) {
        echo "<h1>Manage Users</h1>";
        echo "<table>";
        echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Admin</th></tr>";
        while($row_user = $result_users->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row_user["UserID"] . "</td>";
          echo "<td>" . $row_user["FirstName"] . "</td>";
          echo "<td>" . $row_user["LastName"] . "</td>";
          echo "<td>" . $row_user["Username"] . "</td>";
          echo "<td>" . ($row_user["Admin"] == 1 ? "Yes" : "No") . "</td>";
          echo "<td><a href='edit_user.php?UserID=" . $row_user["UserID"] . "'>Edit</a></td>";
          echo "<td><a href='delete_user.php?UserID=" . $row_user["UserID"] . "'>Delete</a></td>";
          echo "</tr>";
        }
        echo "</table>";
      } else {
        echo "No users found.";
      }

      // Close database connection
      $conn->close();
    ?>
    <!-- End Manage Users -->
  </div>
</div>

<footer>&copy; Copyright 2024</footer>

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
