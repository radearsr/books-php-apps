<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-between align-items-center mb-5">
            <div class="col-6">
                <h2>Tambah Buku</h2>
            </div>
            <div class="col-2">
                <a class="btn btn-warning" href="./index.php">Home</a>
            </div>
        </div>
        <form method="POST" action="./source/tambah_buku_process.php?action=tambahBuku"> 
            <div class="form-group">
                <label for="title">Judul Buku: </label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis Buku:</label>
                <input type="text" class="form-control" name="author" required >
            </div>
            <div class="form-group">
                <label for="jumlah1">Jumlah Buku:</label>
                <input type="number" class="form-control" name="jumlah_buku" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="date" class="form-control" name="tahun_terbit" required>
            </div>
            <button class="btn btn-primary" type="submit">Simpan Buku</button>
        </form>
    </div>   
</body>
</html>