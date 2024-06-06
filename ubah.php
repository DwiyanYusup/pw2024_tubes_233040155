<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'movieindof.php';

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$movie_id = $_GET["movie_id"];
$movie = query("SELECT * FROM movie WHERE movie_id = $movie_id")[0];
// var_dump($movie['title']);

if (isset($_POST["ubah"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'movieindo.php';
            </script>
        ";
    } else {
        echo "
             <script>
                alert('data gagal diubah!');
                document.location.href = 'movieindo.php';
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
    <title>Ubah Film</title>
</head>

<body>
    <h1>Ubah Film</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="movie_id" value="<?= $movie["movie_id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $movie["gambar"]; ?>">
        <ul>
            <li>
                <label for="gambar">Gambar: </label> <br>
                <img src="img/<?= $movie['gambar']; ?>" width="40"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="title">Judul: </label>
                <input type="text" name="title" id="title" required value="<?= $movie['title']; ?>">
            </li>
            <li>
                <label for="release_year">Tahun Rilis: </label>
                <input type="number" name="release_year" id="release_year" required value="<?= $movie["release_year"]; ?>">
            </li>
            <li>
                <label for="genre">Genre: </label>
                <input type="text" name="genre" id="genre" required value="<?= $movie["genre"]; ?>">
            </li>
            <li>
                <label for="director">Sutradara: </label>
                <input type="text" name="director" id="director" required value=" <?= $movie["director"]; ?>">
            </li>
            <li>
                <label for="description">Deskripsi: </label>
                <input type="text" name="description" id="description" required value="<?= $movie["description"]; ?>">
            </li>
            <li>
                <label for="duration">Durasi: </label>
                <input type="time" name="duration" id="duration" required value="<?= $movie["duration"]; ?>">
            </li>
            <li>
                <label for="rating">Rating: </label>
                <input type="text" name="rating" id="rating" step="0.1" required value=" <?= $movie["rating"]; ?>">
            </li>
            <li>
                <button type="submit" name="ubah">Ubah Data!</button>
            </li>
        </ul>
    </form>
</body>

</html>