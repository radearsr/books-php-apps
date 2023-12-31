<?php 

    require "functions.php";

    if (actions($_GET["action"]) > 0) {
        $alert = "<script>
            window.alert('Berhasil melakukan registrasi, silahkan login..');
            window.location.href='../login.php';
                </script>
            ";
        echo $alert;
        
    } else {
        var_dump(mysqli_error($conn));
    }

?>