<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Register Form</h2>
            <form action="./source/register_process.php?action=registerAkun" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="konfirmasi_password">Konfimasi Password:</label>
                    <input type="password" class="form-control" name="konfirmasi_password" required>
                </div>

                <div class="form-group">
                    <label for="pilih_buku">Pilih Buku</label>
                    <select class="form-control" id="pilih_buku" name="role">
                        <option value="" selected disabled>Pilih Posisi Anda</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="PENGUNJUNG">PENGUNJUNG</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <p class="text-center mt-4">Anda Sudah memiliki akun? <a href="./login.php">Masuk Disini</a></p>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS dan Popper.js (diperlukan untuk beberapa komponen Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>