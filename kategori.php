<?php
//Header
include '.includes//header.php';
//Notifikasi
include './.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabel Kategori -->
     <div class="card">
        <div class="card-header d-flex justify-content-between-align-items-center">
            <h4>Data Kategori</h4>
            <!-- Kategori Baru -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">
                Tambah Kategori
             </button>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th>Nama</th>
                            <th width="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- Mengambil data dari DB -->
                         <?php
                         $index = 1;
                         $query = "SELECT * FROM categories";
                         $exec = mysqli_query($conn, $query);
                         while ($category = mysqli_fetch_assoc($exec)) :
                        ?>
                        <tr>
                            <!-- Menampilkan nomor, nama, dan opsi -->
                             <td><?= $index++ ?></td>
                             <td><?= $category['category_name']; ?></td>
                             <td>
                                <!-- Drop down opsi delete dan update -->
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCategory_<?= $category['category_id']; ?>">
                                        <i class="bx bx-edit-alt me-2"></i> Edit
                                    </a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCategory_<?= $category['category_id']; ?>">
                                    <i class="bx bx-edit-alt me-2"></i> Delete </a>
                                </div>
                                </div>
                             </td>
                        </tr>
                        <!-- Modal Hapus Data Kategori -->
                         <div class="modal fade" id="deleteCategory_<?=$category['category_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Kategori?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_kategori.php" method="POST">
                                            <
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>


                        <!-- Modal Update Data Kategori -->

                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
</div>
<?php include '.includes/footer.php';