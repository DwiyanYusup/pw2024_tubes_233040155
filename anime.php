<?php
// koneksi ke database
$db = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040155");
// ambil data dari tabel mahasiswa/query data mahasiswa
$result = mysqli_query($db, "SELECT * FROM animations");
// ambil data (fetch) mahasiswa dari object result
// mysqli_fetch_row() 
// mysqli_fetch_assoc()
// mysqli_fetch_array()
// mysqli_fetch_object()
// while ($mv = mysqli_fetch_assoc($result)) {
//     var_dump($mv);
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>
    <h1>Daftar Anime</h1>
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
            <th>Episode</th>
            <th>Rating</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="">Ubah</a>
                    <a href="">Hapus</a>
                </td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                <td><?= $row["title"]; ?></td>
                <td><?= $row["release_year"]; ?></td>
                <td><?= $row["genre_id"]; ?></td>
                <td><?= $row["director_id"]; ?></td>
                <td><?= $row["description"]; ?></td>
                <td><?= $row["episodes"]; ?></td>
                <td><?= $row["rating"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endwhile; ?>

    </table>
</body>

</html>