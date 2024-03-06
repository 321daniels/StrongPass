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

<body>
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
        </div>
    </nav>

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
            $newNote = htmlspecialchars($_POST['note']);
            $currentTime = date("Y-m-d H:i:s");

            $sql_update = "UPDATE main SET Username = '$newUsername', Password = '$newPassword', Note = '$newNote', LastUpdated = '$currentTime' WHERE MainID = $siteId";
            $result_update = $conn->query($sql_update);

            // Check if update was successful
            if ($result_update) {
                echo '<div class="alert alert-success" role="alert">Entry updated successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error updating password. ' . $conn->error . '</div>';
            }
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

</body>
</html>
