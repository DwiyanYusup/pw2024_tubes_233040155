<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h2>Register</h2>
    <form action="register_process.php" method="post">
        <!-- Tambahkan form field untuk pendaftaran -->
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>

</html>