<?php
$host = "localhost";
$user = "root";      // sesuaikan
$pass = "";          // sesuaikan
$db   = "diagnosa_hp";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
