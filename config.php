<?php

//Konfigurasi koneksi database
$host = "localhost"; // Nama host database
$username = "root"; // Username database
$password = ""; // Password untuk diakses
$database = "idekreatif"; // Nama database

// Membuat koneksi ke database menggunakan MySQLIi
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    //Menampilkan pesan error jika koneksi gagal
    die("Database Gagal Terkoneksi: " . $conn->connect_error);
}

// Jika koneksi tidak error, script akan terus berjalan
?>