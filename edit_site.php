<?php
include 'session.php';

// Check if the user is logged in
if(!isset($_SESSION['UserID'])) {
    header("Location: login.html");
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
<link rel="stylesheet" href=".\css\edit_site.css"/>
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
  <h1>Edit Site Information</h1>
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

    // Check if form is submitted ("edit" or "delete" button clicked)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete']) && $_POST['delete'] === 'true') {
            // Delete entry logic here
            $sql_delete = "DELETE FROM main WHERE MainID = $siteId";
            $result_delete = $conn->query($sql_delete);

            // Check if delete was successful
            if ($result_delete) {
                echo '<div class="alert alert-success" role="alert">Entry deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting entry. ' . $conn->error . '</div>';
            }
        } else {
            // Handle update logic (as before)
            $newUsername = htmlspecialchars($_POST['username']);
            $newPassword = htmlspecialchars($_POST['password']);
			$newVIewerID = htmlspecialchars($_POST['VIewerID']);
            $newNote = htmlspecialchars($_POST['note']);
            $currentTime = date("Y-m-d H:i:s");

            $sql_update = "UPDATE main SET Username = '$newUsername', Password = '$newPassword', VIewerID = '$newVIewerID', Note = '$newNote', LastUpdated = '$currentTime' WHERE MainID = $siteId";
            $result_update = $conn->query($sql_update);

            // Check if update was successful
            if ($result_update) {
                echo '<div class="alert2 alert-success" role="alert">Entry updated successfully!</div>';
            } else {
                echo '<div class="alert2 alert-danger" role="alert">Error updating password. ' . $conn->error . '</div>';
            }
        }
    }

    // Retrieve site information for display
    $sql = "SELECT * FROM main WHERE MainID = $siteId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Display form to edit site information
        echo "<form method='post' class='container'>";
        echo "<div class='form-group'>";
        echo "<h2>" . htmlspecialchars($row["Site"]) . "</h2>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='username'>Username:</label>";
        echo "<input type='text' class='form-control' id='username' name='username' value='" . $row["Username"] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='password'>Password:</label>";
        echo "<input type='text' class='form-control' id='password' name='password' value='" . htmlspecialchars($row["Password"]) . "'>";
        echo "<span id='strength-message' class='text-danger' style='margin-left: 10px;'></span>"; // password strength text here
        echo "</div>";  
		
		echo "<div class='form-group'>";
        echo "<label for='VIewerID'>Share with:</label>";
        echo "<input type='text' class='form-control' id='VIewerID' name='VIewerID' value='" . $row["VIewerID"] . "'>";
        echo "</div>";
        
        echo "<div class='form-group'>";
        echo "<label for='note'>Note:</label>";
        echo "<textarea class='form-control' id='note' name='note' rows='3' style='resize: vertical;'>" . htmlspecialchars($row["Note"]) . "</textarea>";
        echo "</div>";

        echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
    echo "</form>";
       
        // Add Delete button here
        echo "<form method='post' style='display:inline;'>";
        echo "<input type='hidden' name='delete' value='true'>";
        echo "<button type='submit' class='btn btn-danger'>Delete</button>";
        echo "</form>";
    } else {
        echo "<p>Site not found!</p>";
    }

    // Close connection
    $conn->close();
    ?>
</div>

<!-- Password generator form, hidden until user clicks Show Password Generator button -->
<div class="container mt-4">
    <button type="button" class="btn btn-primary" id="showPasswordGenerator">Show Password Generator</button>
    <form id="passwordGeneratorForm" style="display: none;">
        <h3>Password Generator</h3>
        <div class="mb-3">
          <label for="passwordLength" class="form-label">Password Length:</label>
          <input type="number" class="form-control" id="passwordLength" min="6" max="64" value="12" required>
        </div>

        <div class="mb-3">
          <label for="includeUppercase" class="form-check-label">
            <input type="checkbox" class="form-check-input custom-checkbox" id="includeUppercase"> Include Uppercase
          </label>
        </div>

        <div class="mb-3">
          <label for="includeNumbers" class="form-check-label">
            <input type="checkbox" class="form-check-input custom-checkbox" id="includeNumbers"> Include Numbers
          </label>
        </div>

        <div class="mb-3">
          <label for="includeSymbols" class="form-check-label">
            <input type="checkbox" class="form-check-input custom-checkbox" id="includeSymbols"> Include Symbols
          </label>
        </div>

        <div class="mt-3">
            <!-- Ensure the onclick event calls the generatePassword() function -->
            <button class="btn btn-primary" type="button" onclick="generatePassword()">Generate Password</button>
            <input type="text" class="form-control" id="generatedPassword" readonly>
        <div class="container mt-1"></div>
            <!-- Modified from generatedPassword... needed to change functionality to insert into the input/form -->
            <button type="button" class="btn btn-primary" id="insertGeneratedPassword">Insert Generated Password</button>
        </div>

    <script>
        
        // grab the HTML elements for password and strength message
        const passwordInput = document.getElementById('password');
        const strengthMessage = document.getElementById('strength-message');

        // Function to toggle the password generator form upon button click
        function showPasswordGenerator() {
            var passwordGeneratorForm = document.getElementById("passwordGeneratorForm");
            if (passwordGeneratorForm.style.display === "none") {
                passwordGeneratorForm.style.display = "block";
            } else {
                passwordGeneratorForm.style.display = "none";
                }
            }
            
        // Function to insert the generated password into the form
        function useGeneratedPassword() {
            var newGeneratedPassword = document.getElementById("generatedPassword").value;
            var passwordField = document.getElementById("password");
            passwordField.value = newGeneratedPassword;
            alert("Generated password has been inserted into the form. Click 'Save Changes' to apply the new password!");
            strengthCheck(newGeneratedPassword);
            }
    
        // Function to actively check the strength of a password as it is typed
        // Function to actively check the strength of a password as it is typed
        function strengthCheck() {
            const password = passwordInput.value;

            let score = 0;

            // Checks length requirements
            if (password.length >= 12) {
                score += 2;
            } else if (password.length >= 8) {
                score += 1;
            }

            // checks character requirements
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNums = /[0-9]/.test(password);
            // characters that are not alphanumeric
            const hasSpecial = /[^a-zA-Z0-9]/.test(password);

            // if the password contains uppercase, lowercase, number, and special character
            if (hasUpper && hasLower && hasNums && hasSpecial) {
                score += 2;
            // if the password has at least two of the following: uppercase, lowercase, number, or special character
        } else if (hasUpper + hasLower + hasNums + hasSpecial >= 2) {
            score += 1;
        }

            // strength measurement text and color
            let strengthMessage = document.getElementById('strength-message');
            if (score < 2) {
                strengthMessage.textContent = "Weak";
                strengthMessage.className = "strength-message weak";
            } else if (score < 4) {
                strengthMessage.textContent = "Medium";
                strengthMessage.className = "strength-message medium";
            } else if (score == 4) {
                strengthMessage.textContent = "Strong";
                strengthMessage.className = "strength-message strong";
            }
        }


        // check password strength after text entry
        passwordInput.addEventListener('input', strengthCheck);

        // check password strength of current password immediately upon the page loading
        document.addEventListener("DOMContentLoaded", strengthCheck);

        // button click to trigger the password generator form visibility
        document.getElementById("showPasswordGenerator").addEventListener("click", showPasswordGenerator);

        // button to copy the generated password into the form
        document.getElementById("insertGeneratedPassword").addEventListener("click", useGeneratedPassword);
    </script>

  
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

    <script src="generatedPassword.js"></script>
</body>
</html>