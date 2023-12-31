<?php 

    require "functions.php";

    if (actions($_GET["action"]) > 0) {
        $alert = "<script>
            window.alert('Berhasil menambahkan data baru..');
            window.location.href='../index.php';
                </script>
            ";
        echo $alert;
        
    } else {
        var_dump(mysqli_error($conn));
    }

?>