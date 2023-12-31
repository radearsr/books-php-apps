<?php 
    require "functions.php";
    $loginStatusCode = actions($_GET["action"]);
    if ($loginStatusCode == "BERHASIL_LOGIN") {
        $alert = "<script>
            window.alert('Berhasil masuk...');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
    } else if ($loginStatusCode == "PASSWORD_TIDAK_SESUAI") {
        $alert = "<script>
            window.alert('Gagal, Password tidak sesuai silahkan coba lagi..');
            window.location.href='../login.php';
                </script>
            ";
        echo $alert;
    } else if ($loginStatusCode == "USER_TIDAK_DITEMUKAN") {
        $alert = "<script>
            window.alert('Gagal, Username tidak ditemukan silahkan coba lagi..');
            window.location.href='../login.php';
                </script>
            ";
        echo $alert;
    } else {
        var_dump(mysqli_error($conn));
    }

?>