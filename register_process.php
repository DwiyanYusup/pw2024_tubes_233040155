<?php
session_start();
// Koneksi ke database
include 'db_connection.php'; // File ini berisi koneksi ke database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Query untuk menyimpan data pengguna
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
        // Redirect ke halaman login atau halaman lain
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
