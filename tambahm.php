<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'movieindof.php';

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if (tambahm($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'movieindo.php';
            </script>
        ";
    } else {
        echo "
             <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'tambahm.php';
            </script> 
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film/Anime</title>
</head>

<body>
    <h1>Tambah Film/Anime</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="gambar">Gambar: </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="title">Judul: </label>
                <input type="text" name="title" id="title" required>
            </li>
            <li>
                <label for="release_year">Tahun Rilis: </label>
                <input type="number" name="release_year" id="release_year" required>
            </li>
            <li>
                <label for="genre">Genre: </label>
                <input type="text" name="genre" id="genre" required>
            </li>
            <li>
                <label for="director">Sutradara: </label>
                <input type="text" name="director" id="director" required>
            </li>
            <li>
                <label for="description">Sinopsis: </label>
                <input type="text" name="description" id="description" required>
            </li>
            <li>
                <label for="duration">Durasi: </label>
                <input type="time" name="duration" id="duration" required>
            </li>
            <li>
                <label for="rating">Rating: </label>
                <input type="text" name="rating" id="rating" step="0.1" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>
    </form>
</body>

</html>