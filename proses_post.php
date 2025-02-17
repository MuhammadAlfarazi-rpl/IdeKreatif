<?php
include 'config.php';
session_start();

$userId = $_SESSION["user_id"];

if (isset($_POST['simpan'])) {
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES["image"]["name"];
    $imagePath = $imageDir . basename($imageName);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        $query = "INSERT INTO posts (post_title, content, 
        created_at, category_id, user_id, image_path) VALUES 
        ('$postTitle','$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post Succsessfully Uploaded!'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
    } else {
        $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Failed to upload image..' . $conn->error
    ];
}
header('Location: dashboard.php');
exit();
}

if (isset($_POST['delete'])) {
    $postID = $_POST['postID'];

    $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post='$postID'");

    if($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post succsessfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting post: ' . mysqli_error($conn)
        ];
    }
    header('Location: dashboard.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $postId = $_POST['post_id'];
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];
    $imageDir = "assets/img/uploads/";

    if (!empty($_FILES["image_path"]["name"])) {
        $imageName = $_FILES["image_path"]["name"];
        $imagePath = $imageDir . $imageName;

        move_uploaded_file($_FILES["image_path"]["tmp_name"], $imagePath);
        
        $queryOldImage = "SELECT image_path FROM posts WHERE id_post = $postId";
        $resultOldImage = $conn->query($queryOldImage);
        if ($resultOldImage->num_rows > 0) {
            $oldImage = $resultOldImage->fetch_assoc()['image_path'];
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
    } else {
        $imagePathQuery = "SELECT image_path from posts where id_post = $postId";
        $result = $conn->query($imagePathQuery);
        $imagePath = ($result->num_rows > 0) ? $result->fetch_assoc()['image_path'] : null;
    }

    $queryUpdate = "UPDATE posts set post_title = '$postTitle', 
    content = '$content', category_id = $categoryId, 
    image_path = '$imagePath' where id_post = $postId";

    if ($conn->query($queryUpdate) === true ) {
        // Berhasil
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post succsessfully updated.'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error updating post: ' . mysqli_error($conn)
            ];
        }
        header('Location: dashboard.php');
        exit();
    }


