<!-- Add a new site to the database -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StrongPass - Add Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./Index.html">StrongPass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                </ul>
            </div>
        </div>
    </nav>


    <main class="container">
        <h1>Add a New Password</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $siteName = $_POST["siteName"];
            // Different from the $username and $password to avoid conflict from database credentials
            $addUsername = $_POST["username"];
            $addPassword = $_POST["password"];
            $currentTime = date("Y-m-d H:i:s");
            $note = $_POST["note"];
            $url = $_POST["url"];
        
            // Generate error message if the site name, username, or password are empty
            if (empty($siteName) || empty($addUsername) || empty($addPassword)) {
                echo '<div class="alert alert-danger" role="alert">Please fill in all required fields!</div>';
            } else {

                $servername = "localhost";
                $username = "test";
                $password = "test";
                $database = "strongpass";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Create the new database entry
                $sql = "INSERT INTO main (Site, Username, Password, LastUpdated, Note, URL) VALUES ('$siteName', '$addUsername', '$addPassword', '$currentTime', '$note', '$url')";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Password added successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error adding password: ' . $conn->error . '</div>';
                }

                $conn->close();
            }
        }
        ?>
        <!-- User form -->
        <form id="add-password-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="siteName" class="form-label">Site Name:</label>
                <input type="text" name="siteName" id="siteName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note (optional):</label>
                <textarea name="note" id="note" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL (optional):</label>
                <input type="url" name="url" id="url" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Password</button>
        </form>
    </main>
</body>

</html>