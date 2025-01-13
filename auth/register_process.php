<?php
require_once("../config.php");
//Memulai session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$hashedPassword' )";
    if ($conn->query($sql) === TRUE) {
        //Simpan Notifikasi kedalam session
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Registrasi Berhasil!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Registrasi Gagal!'
        ];
    }
    header('Location: login.php');
    exit();
}

$conn->close();
?>