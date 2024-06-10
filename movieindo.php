<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Include database connection and functions
require_once 'movieindof.php';

// Fetch all movies initially
$movies = query("SELECT * FROM movie");

// Handle search functionality
if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $movies = cari($keyword);
}

// Display success or error messages from session
function displayMessage($type)
{
    if (isset($_SESSION[$type])) {
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                ' . $_SESSION[$type] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION[$type]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar-custom {
            background-color: #343a40;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .btn {
            color: white;
            font-weight: bold;
        }

        .load {
            width: 130px;
            position: absolute;
            top: -30px;
            left: 430px;
            z-index: -1;
            display: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid mx-3">
            <a class="navbar-brand" href="#">Daftar Film Indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <li><a class="dropdown-item" href="tambahm.php">Tambah Film</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3">Daftar Film Indonesia</h1>

        <!-- Display success or error messages -->
        <?php displayMessage('success'); ?>
        <?php displayMessage('error'); ?>

        <form action="" method="post" class="mb-3 col-5">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off" id="keyword">
                <button type="submit" name="cari" class="btn btn-primary" id="tombol-cari">Cari!</button>

                <img src="img/loading.gif" class="load">
            </div>
        </form>

        <div id="container">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <th scope="col">Aksi</th>
                        <?php endif; ?>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tahun Rilis</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Sutradara</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($movies as $movie) : ?>
                        <tr class="<?= $i % 2 === 0 ? 'table-active' : ''; ?>">
                            <td><?= $i; ?></td>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <td>
                                    <a href="ubah.php?movie_id=<?= $movie["movie_id"]; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="hapus.php?movie_id=<?= $movie["movie_id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin untuk menghapus?');">Hapus</a>
                                </td>
                            <?php endif; ?>
                            <td><img src="img/<?= $movie["gambar"]; ?>" width="50"></td>
                            <td><?= $movie["title"]; ?></td>
                            <td><?= $movie["release_year"]; ?></td>
                            <td><?= $movie["genre"]; ?></td>
                            <td><?= $movie["director"]; ?></td>
                            <td><?= $movie["description"]; ?></td>
                            <td><?= $movie["duration"]; ?></td>
                            <td><?= $movie["rating"]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Profile -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Username: <?= $_SESSION['username'] ?></p>
                    <p>Role: <?= $_SESSION['role'] ?></p>
                    <!-- Add more details if needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser">
                        Edit
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit_profile.php?user_id=<?= $_SESSION['user_id'] ?>" method="post" id="editProfileForm">
                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username" value="<?= $_SESSION['username'] ?>" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password baru" required />
                        </div>

                        <!-- Submit button -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.1.min (1).js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>