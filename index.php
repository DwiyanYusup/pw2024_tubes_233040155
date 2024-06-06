<?php

require 'register.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Pastikan Anda menghubungkan CSS Anda -->
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <!-- Tempat untuk menambahkan tombol Register dan Login -->
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else : ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>