<?php 

    require "functions.php";

    $statusPeminjamanBuku = actions($_GET["action"]);

    if ($statusPeminjamanBuku == "JUMLAH_BUKU_TIDAK_CUKUP") {
        $alert = "<script>
            window.alert('Gagal meminjam, buku tidak tersedia dengan jumlah yang ingin anda pinjam, silahkan coba lagi...');
            window.location.href='../peminjaman_buku.php';
                </script>
            ";
        echo $alert;
        
    } else if ($statusPeminjamanBuku == "GAGAL_SAAT_MEMPERBARUI_JUMLAH_BUKU") {
        $alert = "<script>
            window.alert('Gagal meminjam, terjadi kegagalan saat memperbarui jumlah buku...');
            window.location.href='../peminjaman_buku.php';
                </script>
            ";
        echo $alert;
    } else if ($statusPeminjamanBuku > 0) {
        $alert = "<script>
            window.alert('Berhasil meminjam....');
            window.location.href='../peminjaman_buku.php';
                </script>
            ";
        echo $alert;
    } else {
        var_dump(mysqli_error($conn));
    }

?>