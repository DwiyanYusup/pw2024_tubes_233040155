<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'movieindof.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_GET["user_id"]; // Ensure user_id is properly retrieved from URL

    // Tangkap data dari form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // Update data ke database
    $query = "UPDATE user SET username = '$username', password = '$password' WHERE id = '$user_id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Update session with new username
        $_SESSION['username'] = $username;

        // Redirect back to movieindo.php with success message
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: movieindo.php");
        exit;
    } else {
        // If query fails
        $_SESSION['error'] = "Failed to update profile";
        header("Location: movieindo.php");
        exit;
    }
}

// If not POST method, you might want to handle this case or redirect
