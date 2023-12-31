<?php 
    require "functions.php";

    if (actions($_GET["action"]) > 0) {
        $alert = "<script>
            window.alert('Berhasil menghapus data!');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
    }elseif (mysqli_error($conn) != "") {
        $alert = "<script>
            window.alert('Maaf data ini sedang digunakan untuk data lain anda tidak bisa menghapus data ini saat sedang digunakan!!');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
    } else {
        var_dump(mysqli_error($conn));
    }


?>