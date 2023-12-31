<?php 
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "perpustakaan";

$conn = mysqli_connect($serverName, $username, $password, $dbName);

if (!$conn) {
    echo "<h1 style='text-align: center; color : red; background-color: black; padding: 10px 0'>Gagal Menyambung ke Database</h1>";
    die;
}

?>