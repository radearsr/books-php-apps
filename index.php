<?php
    require "./source/functions.php";
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: ./login.php");
        exit;
    }
    $user_role = $_SESSION["role"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
    <body>
        <div class="container mt-5">

            <h2 class="mb-3">Daftar Buku</h2>
            <div class="row mb-3 mb-5 justify-content-between align-items-center">
                <div class="col-6">
                    <?php if ($user_role == "ADMIN") :?>
                        <a class="btn btn-primary mr-2" href="tambah_buku.php">Tambah Buku</a>
                    <?php endif;?>
                    <a class="btn btn-info mr-2" href="peminjaman_buku.php">Peminjaman Buku</a>
                    <a class="btn btn-warning mr-2" href="pengembalian_buku.php">Pengembalian Buku</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-outline-danger" href="./source/logout_process.php">Log Out</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Jumlah</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $books = fetchData("SELECT * FROM books")?>
                    <?php foreach($books as $book) :?>
                        <tr>
                            <td><?= $book["id_buku"] ?></td>
                            <td><?= $book["title"] ?></td>
                            <td><?= $book["author"] ?></td>
                            <td><?= $book["jumlah"] ?></td>
                            <td><?= $book["tahun"] ?></td>
                            <td>
                                <a class="btn btn-warning" href="./edit_buku.php?id=<?= $book["id_buku"] ?>">Edit</a>
                                <a class="btn btn-danger" href="./source/hapus_buku_process.php?action=hapusBuku&id_buku=<?= $book["id_buku"] ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
