<?php
session_start();

// Function to check if the user is an admin
function isAdmin() {
    return isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1;
}
function getUserID() {
    return isset($_SESSION['UserID']) ? $_SESSION['UserID'] : null;
}

?>