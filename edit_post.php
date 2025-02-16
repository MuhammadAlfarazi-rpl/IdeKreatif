<?php
include 'config.php';
include '.includes/header.php';

$postIdToEdit = $_GET['post_id'];

$query = "SELECT * FROM posts WHERE id_post = $postIdToEdit";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Post not found";
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
     <div class="row">
        <!-- Form untuk mengedit post -->
         <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Formulir metode POST untuk mengirim data -->
                     <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                        <!-- Input tersembunti menyimpan ID postingan -->
                         <input type="hidden" name="post_id" value="<?php echo $postIdToEdit; ?>">

                         <!-- Tired of this comment man.. anyway. Input untuk judul postingan -->
                          <div class="mb-3">
                            <label for="post_title" class="form-label">Judul Postingan</label>
                            <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post['post_title']; ?>" required>
                          </div>

                          <!-- Input untuk unggah gambar -->
                           <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah Gambar</label>
                            <input class="form-control" type="file" id="formFile" name="image_path" accept="image/*">
                            <?php if (!empty($post['image_path'])): ?>
                                <!-- Menampilkan gambar yang sudah diunggah -->
                                 <div class="mt-2">
                                    <img src="<?= $post['image_path']; ?>" alt="CurrentImage" class="img-thumbnail" style="max-width: 200px";>
                                 </div>
                                 <?php endif; ?>
                           </div>

                           <!-- Dropdown untuk kategori -->
                           <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Select one</option>
                                <?php
                                $queryCategories = "SELECT * FROM categories";
                                $resultCategories = $conn->query($queryCategories);

                                if ($resultCategories->num_rows > 0) {
                                    while ($row = $resultCategories->fetch_assoc()) {
                                        $selected = ($row["category_id"] == $post['category_id']) ? "selected" : "";
                                        echo "<option value='" . $rows["category_id"] . "' $selected>" . $row["category_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                           </div>

                           <!-- Textarea untuk postingan -->
                            <div class="mb-3">
                                <label for="content" class="form-label">Konten</label>
                                <textarea class="form-control" id="content" name="content"required><?php echo $post['content']; ?></textarea>
                            </div>

                            <!-- Tombol untuk memperbarui postingan -->
                             <button type="submit" name="update" class="btn btn-primary">Update</button>
                     </form>
                </div>
            </div>
         </div>
     </div>
</div>

<?php
include '.includes/footer.php';
?>