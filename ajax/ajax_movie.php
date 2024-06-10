<?php
session_start();

require '../movieindof.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM movie
                WHERE
            title LIKE '%$keyword%' OR
            release_year LIKE '%$keyword%' OR  
            genre LIKE '%$keyword%' OR  
            director LIKE '%$keyword%' OR  
            description LIKE '%$keyword%' OR  
            duration LIKE '%$keyword%' OR  
            rating LIKE '%$keyword%'
            ";
$movies = query($query);
// var_dump($movie);
// die();
?>

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