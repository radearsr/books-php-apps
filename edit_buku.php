<?php require './source/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Buku</h2>
        <form method="POST" action="./source/edit_buku_process.php?action=editBuku"> 
            <?php $bookId = $_GET["id"]?>
            <?php $detailsBook = fetchData("SELECT * FROM books WHERE id_buku = '$bookId'")?>
            <?php foreach($detailsBook as $detailBook) :?>
            <input type="hidden" name="id_buku" value="<?= $detailBook["id_buku"] ?>"> 
            <div class="form-group">
                <label for="title">Judul Buku: </label>
                <input type="text" class="form-control" name="title" value="<?= $detailBook["title"] ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis Buku:</label>
                <input type="text" class="form-control" name="author" value="<?= $detailBook["author"] ?>" required >
            </div>
            <div class="form-group">
                <label for="jumlah_buku">Jumlah Buku:</label>
                <input type="number" class="form-control" name="jumlah_buku" value="<?= $detailBook["jumlah"] ?>" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="date" class="form-control" name="tahun_terbit" value="<?= $detailBook["tahun"] ?>" required>
            </div>
            <?php endforeach;?>
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </form>
    </div>   
</body>
</html>