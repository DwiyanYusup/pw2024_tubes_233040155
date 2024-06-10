<?php
require 'movieindof.php';

if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            margin-bottom: 10px;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <main class="form-signin w-100 m-auto">
        <form action="" method="post">
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                <label for="password2">Confirm Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit" name="registrasi">Sign up</button>

            <span class="login-link">Already have an account? <a href="index.php">Sign in here</a></span>

        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>