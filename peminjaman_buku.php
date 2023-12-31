<?php
    require "./source/functions.php";
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: ./login.php");
        exit;
    }

    $id_user = $_SESSION["id_user"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-5">
            <div class="col-6">
                <h2>Peminjaman Buku</h2>
            </div>
            <div class="col-2">
                <a class="btn btn-warning" href="./index.php">Home</a>
            </div>
        </div>
        <form method="POST" action="./source/peminjaman_buku_process.php?action=peminjamanBuku"> 
            <div class="form-group">
                <label for="pilih_buku">Pilih Buku</label>
                <select class="form-control" id="pilih_buku" name="id_buku">
                    <option value="" selected disabled>Pilih Buku Disini</option>
                    <?php $books = fetchData("SELECT * FROM books")?>
                    <?php foreach($books as $book) :?>
                    <option value="<?= $book["id_buku"] ?>"><?= $book["title"] ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_pinjam">Jumlah Pinjam:</label>
                <input type="number" class="form-control" name="jumlah_pinjam" required>
            </div>
            <input type="hidden" value="<?= $id_user ?>" name="id_user">
            <button class="btn btn-primary" type="submit">Pinjam Buku</button>
        </form>
    </div>   
</body>
</html>