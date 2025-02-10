<?php
include("config.php");
session_start();

if (isset($_POST['simpan'])) {
    $category_name = $_POST['category_name'];

    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    $exec = mysqli_query($conn, $query);

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Kategori Berhasil Ditambahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => "Kategori Gagal Ditambahkan.."
        ];
    }

    header('Location: kategori.php');
    exit();
}

if (isset($_POST['delete'])) {
    $catID = $_POST['catID'];

    $exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$catID'");

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Kategori Berhasil Dihapus!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => "Kategori Gagal Dihapus.."
        ];
    }

    header('Location: kategori.php');
    exit();
}

if (isset($_POST['update'])) {
    $catID = $_POST['catID'];
    $category_name = $_POST['category_name'];

    $query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$catID'";
    $exec = mysqli_query($conn, $query);

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Kategori Berhasil Diperbarui!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => "Kategori Gagal Diperbarui.."
        ];
    }

    header('Location: kategori.php');
    exit();
}