<?php
// koneksi ke database
$db = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040155");


function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    // var_dump($namaFile);
    // die();

    // cek apakah tidak ada gambar yang diupload
    if ($error == 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
                </script>";
        return false;
    }

    // cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
            </script>";
        return false;
    }

    // cek jika ukuran terlalu besar 
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // var_dump($namaFileBaru);
    // die;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function tambahm($data)
{
    global $db;

    // Sanitize input to prevent XSS attacks
    $title = htmlspecialchars($data["title"]);
    $release_year = htmlspecialchars($data["release_year"]);
    $genre = htmlspecialchars($data["genre"]);
    $director = htmlspecialchars($data["director"]);
    $description = htmlspecialchars($data["description"]);
    $duration = htmlspecialchars($data["duration"]);
    $rating = htmlspecialchars($data["rating"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Construct the SQL query
    $query = "INSERT INTO movie (gambar, title, release_year, genre, director, rating, duration, description) 
        VALUES ('$gambar', '$title', '$release_year', '$genre', '$director', '$rating', '$duration', '$description')";

    $result = mysqli_query($db, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}





function hapus($movie_id)
{
    global $db;

    if (!is_numeric($movie_id)) {
        return 0;
    }

    $result = mysqli_query($db, "SELECT gambar FROM movie WHERE movie_id = $movie_id");
    $file = mysqli_fetch_assoc($result);

    if ($file) {
        $filePath = 'img/' . $file["gambar"];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        mysqli_query($db, "DELETE FROM movie WHERE movie_id = $movie_id");

        return mysqli_affected_rows($db);
    } else {
        return 0;
    }
}



function ubah($data)
{
    global $db;

    $movie_id = $data['movie_id'];
    $title = htmlspecialchars($data["title"]);
    $release_year = htmlspecialchars($data["release_year"]);
    $genre = htmlspecialchars($data["genre"]);
    $director = htmlspecialchars($data["director"]);
    $description = htmlspecialchars($data["description"]);
    $duration = htmlspecialchars($data["duration"]);
    $rating = htmlspecialchars($data["rating"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE movie SET
                gambar = '$gambar',
                title = '$title',
                release_year = '$release_year',
                genre = '$genre',
                director = '$director',
                description = '$description',
                duration = '$duration',
                rating = '$rating'

            WHERE movie_id = $movie_id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


function cari($keyword)
{
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
    return query($query);
}


function registrasi($data)
{
    global $db;


    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);


    // cek username sudah ada apa belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah digunakan!')
            </script>";
        return false;
    }
    // cek konfirmasi
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!'); 
                </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke data base
    mysqli_query($db, "INSERT INTO user VALUES(NULL, '$username', '$password')");
    return mysqli_affected_rows($db);
}
