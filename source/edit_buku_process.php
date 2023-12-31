<?php 
    require "functions.php";

    if (actions($_GET["action"]) > 0) {
        $alert = "<script>
            window.alert('Berhasil memperbarui data!');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
    } elseif (mysqli_error($conn) == "") {
        $alert = "<script>
            window.alert('Berhasil memperbarui data!');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
    } else {
        var_dump(mysqli_error($conn));
    }


?>