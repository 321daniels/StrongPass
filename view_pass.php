<!-- View all saved passwords on this page -->
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
    <style>
        .passwordLayout {
            text-align: center;
            padding-top: 50px;
        }

        #searchForm {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        #searchInput,
        button {
            margin: 0;
        }

        .centered-buttons {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>

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
<h1>Passwords</h1>
        <!-- Add a new password (redirects) -->
    <section class="passwordLayout centered-buttons">
        <button type="button" onclick="window.location.href='add_password.php'">Add a new password</button>
    </section>
    

    <!-- PHP Search Form -->
    <form id="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="search" id="searchInput" placeholder="Search for a website..."
            value="<?php if (isset($_POST['search'])) {
                echo $_POST['search'];
            } ?>">
        <button type="submit">Search</button>
        <select name="sort" id="sortSelect" onchange="this.form.submit()">
            <option value="site_asc">Site (A-Z)</option>
            <option value="site_desc">Site (Z-A)</option>
            <!-- Add more sorting options as needed -->
        </select>
    </form>

   
    <!-- PHP Search Results -->
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

    // Step 3: Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve search term
        $search = $_POST['search'];

        // Step 4: Construct and execute SQL query
        $sql = "SELECT * FROM main WHERE Site LIKE '%$search%'";

        // Handle sorting
        if (isset($_POST['sort'])) {
            $sort = $_POST['sort'];
            switch ($sort) {
                case 'site_asc':
                    $sql .= " ORDER BY Site ASC";
                    break;
                case 'site_desc':
                    $sql .= " ORDER BY Site DESC";
                    break;
                // Add more cases for other sorting options if needed
            }
        }

        $result = $conn->query($sql);

        /// Step 5: Display search results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
				echo "<div class='centered-buttons'>";
				$siteName = $row["Site"];
				$siteId = $row["MainID"]; // Assuming "id" column uniquely identifies each entry
				$url = $row["URL"];
				echo "<div style='display: block; margin-bottom: 10px;'><button type='button' style='width: 200px;' onclick=\"window.location.href='view_site.php?id=$siteId'\"><img src='$url/favicon.ico' style='width: 20px; height: 20px;'> $siteName</button>";
			}
			echo "</div>";
		} else {
			echo "<p>No results found</p>";
		}
    }
    ?>
    </body>
</html>