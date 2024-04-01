<?php
include 'session.php';

// Check if the user is logged in
if(!isset($_SESSION['UserID'])) {
    header("Location: login_page.html");
    exit();
}
$Admin=isAdmin();
$UserID = getUserID();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Strongpass</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href=".\css\style.css"/>
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
    <!-- New button added -->
    <a href="logout.php" class="w3-bar-item w3-button w3-hover-white">
      <?php
        if ($Admin) {
          echo $UserID.' Admin Logout';
        } else {
          echo $UserID.' User Logout';
        }
      ?>
    </a>
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
    <h1>Support</h1>

    <p>
      Welcome to StrongPass support! If you have any questions, issues, or
      need assistance with our password manager, please feel free to reach out
      to our support team.
    </p>

    <h2 class="text-center">Contact Information</h2>
    <p class="text-center"><strong>Email:</strong> support@strongpass.com</p>
    <p class="text-center"><strong>Phone:</strong> +1 (800) STRONG</p>

    <h2 class="text-center">Frequently Asked Questions (FAQs)</h2>
    <p class="text-center">
      Check out our <a href="faq.php">FAQ page</a> to find answers to common
      questions and troubleshooting tips.
    </p>
  </div>

  <footer class="mt-5">
    &copy; Copyright 2024
  </footer>

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
    
    // Modal Image Gallery
    function onClick(element) {
      document.getElementById("img01").src = element.src;
      document.getElementById("modal01").style.display = "block";
      var captionText = document.getElementById("caption");
      captionText.innerHTML = element.alt;
    }
    </script>

</body>
</html>