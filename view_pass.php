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
<link rel="stylesheet" href=".\css\view_pass.css"/>
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
<div class="w3-main" style="margin-left: 340px; margin-right: 40px;">
  <div class="container mt-4">
    <h1 style="text-align: center; font-size: 48px;">Passwords</h1>

    <!-- Add a new password (redirects) -->
    <section class="passwordLayout centered-buttons">
        <button type="button" onclick="window.location.href='add_password.php'">Add a new password</button>
    </section>

    <!-- PHP Search Form with Category Filter -->
    <div class="search-container">
        <form id="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="search" id="searchInput" placeholder="Search for a website..."
                value="<?php if (isset($_POST['search'])) { echo $_POST['search']; } ?>">
            <button type="submit">Search</button>
            <select name="sort" id="sortSelect" onchange="this.form.submit()">
                <option value="site_asc" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'site_asc') echo 'selected'; ?>>Site (A-Z)</option>
                <option value="site_desc" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'site_desc') echo 'selected'; ?>>Site (Z-A)</option>
                <!-- Add more sorting options as needed -->
            </select>
            <!-- New Category Filter -->
            <select name="category" id="categorySelect" onchange="this.form.submit()">
                <option value="all" <?php if(isset($_POST['category']) && $_POST['category'] == 'all') echo 'selected'; ?>>All Categories</option>
                <option value="gaming" <?php if(isset($_POST['category']) && $_POST['category'] == 'gaming') echo 'selected'; ?>>Gaming</option>
                <option value="education" <?php if(isset($_POST['category']) && $_POST['category'] == 'education') echo 'selected'; ?>>Education</option>
                <option value="social" <?php if(isset($_POST['category']) && $_POST['category'] == 'social') echo 'selected'; ?>>Social Media</option>
                <option value="streaming" <?php if(isset($_POST['category']) && $_POST['category'] == 'streaming') echo 'selected'; ?>>Streaming Service</option>
            </select>
        </form>
        <!-- Toggle View Button -->
        <button type="button" id="toggleViewButton" style="padding: 5px;" onclick="toggleView()">
          <img src="Images/row_icon.png" alt="Grid View" id="toggleImageView" style="width: 20px; height: 20px;">
        </button>
      </div>
    <div id="searchResults" class="row-view"><!-- Assuming initial view is row view --></div>
</div>

<!-- start of ShareSeen logic -->
<?php
    // Step 1: Establish a connection to MySQL database
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
    
    function check_new_shared_passwords($userID) {
        global $conn;
        // If the user's ID matches the ViewerID, and has never received a shared password alert, show alert
        $sql = "SELECT * FROM main WHERE VIewerID = ? AND ShareSeen = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            echo "Found " . $result->num_rows . " unseen entries. <br>";

            while ($row = $result->fetch_assoc()) {
                $sites[] = $row['Site'];
            }
            
                // ShareSeen set to 1 after the password has been seen by the user
                
                $updateSql = "UPDATE main SET ShareSeen = 1 WHERE VIewerID = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("i", $userID);
                $updateStmt->execute();
                $updateStmt->close();

                // Alert displayed to user
                foreach ($sites as $site) {
                    // STYLING IS NOT IDEAL -- Can we fix? I wanted it like the "Password added successfully" message on add_password.php, but it wasn't working
                    echo "<div class='alert' role='alert'>A new password has been shared for $site.</div>";
                }
        } 
        // Uncomment for debugging purposes. Identifies the user logged in
        // else {
        //     echo "No unseen entries found for UserID " . $userID . "<br>";
        // }
        $stmt->close();
    }

    check_new_shared_passwords($UserID);

    $conn->close();
?>

    <!-- PHP Password Display -->
    <?php
// Step 1: Establish a connection to MySQL database
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // MySQL username
$password = "test"; // MySQL password
$database = "strongpass"; // MySQL database name

// Password age and length variables to be populated from database query
$passAgeDays = "";
$passLength = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Grab the password age and length requirements
    $sql = "SELECT PassAge, PassLength from adminset";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $passAgeDays = (int) $row["PassAge"];
        $passLength = (int) $row["PassLength"];
    }
}

// Step 3: Construct and execute SQL query
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'site_asc';
$search = isset($_POST['search']) ? $_POST['search'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : 'all';

$sql = "SELECT * FROM main where UserId = ".$UserID;

// Append search condition if present
if (!empty($search)) {
    $sql .= " and Site LIKE '%" . $conn->real_escape_string($search) . "%'";
}

// Add category filter
if ($category !== 'all') {
    if (empty($search)) {
		$sql .= " AND";
    }
    $sql .= " `Category` = '" . $conn->real_escape_string($category) . "'";
}

//Add viewer results
$sql .= " or ViewerID = ".$UserID." and ShareLock = '0'";

if (!empty($search)) {
    $sql .= " and Site LIKE '%" . $conn->real_escape_string($search) . "%'";
}
// Add category filter
if ($category !== 'all') {
    if (empty($search)) {
        $sql .= " AND";
    }
    $sql .= " `Category` = '" . $conn->real_escape_string($category) . "'";
}

// Handle sorting
switch ($sort) {
    case 'site_asc':
        $sql .= " ORDER BY Site ASC";
        break;
    case 'site_desc':
        $sql .= " ORDER BY Site DESC";
        break;
    // Add more cases for other sorting options if needed
}

$result = $conn->query($sql);

// Step 5: Display search results
if ($result->num_rows > 0) {
    // Add toggle button for view
    echo "<div id='siteContainer' class='centered-buttons'>";
    while ($row = $result->fetch_assoc()) {
        $siteName = $row["Site"];
        $siteId = $row["MainID"]; 
        $url = $row["URL"];
        
        // Grabs each individual password to determine length. Different than database connection password
        $passwrd = $row["Password"];
        $passwordLength = strlen($passwrd);

        // Calculate days since update and set icon variable
        $lastUpdated = strtotime($row["LastUpdated"]);
        $today = time();
        $daysSinceUpdate = floor(($today - $lastUpdated) / (60*60*24));
        $icon = "";

        // Show alert icon if the age of the password age exceeds the setting enforced by the admin
        if ($daysSinceUpdate >= $passAgeDays) {
            $icon = "<img src='./Images/alert_triangle.png'>";
            // Show alert icon if the length of the password is under the setting enforced by the admin
        } else if ($passLength > $passwordLength) {
            $icon = "<img src='./Images/alert_triangle.png'>";
        }
        echo "<div class='siteItem'>";
        echo "<button type='button' onclick=\"window.location.href='view_site.php?id=$siteId'\">" . $icon . "<img src='$url/favicon.ico' style='width: 20px; height: 20px;'> $siteName</button>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No results found</p>";
}
?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleViewButton = document.getElementById('toggleViewButton');
        const siteContainer = document.getElementById('siteContainer');

        // Initially set the view to grid
        siteContainer.classList.add('grid-view');

        toggleViewButton.addEventListener('click', function() {
            // Toggle between row and grid view
            siteContainer.classList.toggle('row-view');
            siteContainer.classList.toggle('grid-view');
        });
    });
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

<script>
    function toggleView() {
        var imageView = document.getElementById("toggleImageView");
        var currentSrc = imageView.getAttribute("src");
        
        // Define the paths for the images
        var rowIconPath = "Images/row_icon.png";
        var gridIconPath = "Images/grid_icon.png";

        // Toggle between the images
        if (currentSrc === rowIconPath) {
            imageView.setAttribute("src", gridIconPath);
            imageView.setAttribute("alt", "Grid View");
        } else {
            imageView.setAttribute("src", rowIconPath);
            imageView.setAttribute("alt", "Row View");
        }
    }
</script>

</body>
</html>