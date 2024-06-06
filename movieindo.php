<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'movieindof.php';
$movie = query("SELECT * FROM movie");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $movie = cari($_POST["keyword"]);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar Film Indonesia</h1>

    <a href="tambahm.php">Tambah Film</a>
    <br><br>

    <form action="" method="post">

        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian..." autocomplete="off">
        <button type="submit" name="cari">Cari!</button>

    </form>

    <br>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Tahun Rilis</th>
            <th>Genre</th>
            <th>Sutradara</th>
            <th>Deskripsi</th>
            <th>Durasi</th>
            <th>Rating</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($movie as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="ubah.php?movie_id=<?= $row["movie_id"]; ?>">Ubah</a>
                    <a href="hapus.php?movie_id=<?= $row["movie_id"]; ?>" onclick="return confirm('yakin deck?');">Hapus</a>
                </td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                <td><?= $row["title"]; ?></td>
                <td><?= $row["release_year"]; ?></td>
                <td><?= $row["genre"]; ?></td>
                <td><?= $row["director"]; ?></td>
                <td><?= $row["description"]; ?></td>
                <td><?= $row["duration"]; ?></td>
                <td><?= $row["rating"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>