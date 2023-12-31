<?php 

    require "functions.php";

    $statusPengembalianBuku = actions($_GET["action"]);

    if ($statusPengembalianBuku == "GAGAL_SAAT_MEMPERBARUI_JUMLAH_BUKU") {
        $alert = "<script>
            window.alert('Gagal mengembalikan, terjadi kegagalan saat memperbarui jumlah buku...');
            window.location.href='../pengembalian_buku.php';
                </script>
            ";
        echo $alert;
    } else if ($statusPengembalianBuku > 0) {
        $alert = "<script>
            window.alert('Berhasil mengembalikan buku....');
            window.location.href='../pengembalian_buku.php';
                </script>
            ";
        echo $alert;
    } else {
        var_dump(mysqli_error($conn));
    }

?>