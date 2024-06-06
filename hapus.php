<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'movieindof.php';

$movie_id = $_GET['movie_id'];
// var_dump($movie_id);
// die();

if (hapus($movie_id) > 0) {
    echo "
    
    <script>
        alert('data berhasil dihapus!');
        document.location.href = 'movieindo.php';
    </script>
    
    ";
} else {
    echo "
    <script>
        alert('data gagal dihapus!');
        document.location.href = 'movieindo.php';
    </script>
    ";
}
