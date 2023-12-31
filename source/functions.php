<?php
require "config.php";


function fetchData($query) {
    global $conn;
    $results = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($results) ) {
        $rows [] = $row;
    }
    return $rows;
}

function actions($actionName) {
    global $conn;
    switch ($actionName) {
        case "tambahBuku":
            return tambahBuku($_POST, $conn);
            break;
        case "editBuku":
            return editBuku($_POST, $conn);
            break;
        case "hapusBuku":
            return hapusBuku($_GET, $conn);
            break;
        case "registerAkun":
            return registerAkun($_POST, $conn);
            break;
        case "loginAkun":
            return loginAkun($_POST, $conn);
            break;
        case "peminjamanBuku":
            return peminjamanBuku($_POST, $conn);
            break;
        case "pengembalianBuku":
            return pengembalianBuku($_POST, $conn);
            break;
        default:
            return "<center><h1>AKSI TIDAK DITEMUKAN</h1><center>";
            break;
    }
}

function tambahBuku($post, $conn) {
    $title        = $post["title"];
    $author       = $post["author"];
    $jumlah_buku  = $post["jumlah_buku"];
    $tahun_terbit = $post["tahun_terbit"];
    $query = "INSERT INTO `books` VALUES (NULL, '$title', '$author', '$jumlah_buku', '$tahun_terbit')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editBuku($post, $conn) {
    $id_buku      = $post["id_buku"];
    $title        = $post["title"];
    $author       = $post["author"];
    $jumlah_buku  = $post["jumlah_buku"];
    $tahun_terbit = $post["tahun_terbit"];
    $query = "UPDATE books SET title = '$title', author = '$author', jumlah = '$jumlah_buku', tahun = '$tahun_terbit' WHERE id_buku = '$id_buku'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusBuku($get, $conn) {
    $id_buku     = $get["id_buku"];
    $query = "DELETE FROM books WHERE id_buku = '$id_buku'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function registerAkun($data, $conn){
    $username             = $data["username"];
    $role                 = $data["role"];
    $password             = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password  = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
    if ( $password !== $konfirmasi_password) {
        echo "<script>alert('Konfirmasi password tidak sama')</script>";
        return false;
    }
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO `users` VALUES(NULL, '$username', '$passwordHashed', '$role')");
    return mysqli_affected_rows($conn);
}

function loginAkun($data, $conn){
    $username          = $data["username"];
    $password          = mysqli_real_escape_string($conn, $data["password"]);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if ( mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id_user"]    = $row["id"];
            $_SESSION["role"]  = $row["role"];
            return "BERHASIL_LOGIN";
        }
        return "PASSWORD_TIDAK_SESUAI";
    }
    return "USER_TIDAK_DITEMUKAN";
}

function peminjamanBuku($post, $conn) {
    $id_buku        = $post["id_buku"];
    $id_user        = $post["id_user"];
    $jumlah_pinjam  = $post["jumlah_pinjam"];
    $bookResults = fetchData("SELECT jumlah FROM books WHERE id_buku = '$id_buku'");
    $currentBookCount = $bookResults[0]["jumlah"];

    if ($currentBookCount < $jumlah_pinjam) {
        return "JUMLAH_BUKU_TIDAK_CUKUP";
    }

    $jumlahBukuSetelahPinjam = $currentBookCount - $jumlah_pinjam;
    $queryUpdateBook = "UPDATE `books` SET jumlah = '$jumlahBukuSetelahPinjam' WHERE id_buku = '$id_buku '";
    mysqli_query($conn, $queryUpdateBook);
    $updatedBooks = mysqli_affected_rows($conn);

    if ($updatedBooks < 1) {
        return "GAGAL_SAAT_MEMPERBARUI_JUMLAH_BUKU";
    }

    $listPinjamanBuku = fetchData("SELECT jumlah FROM peminjaman WHERE id_buku = '$id_buku' AND id_user = '$id_user'");

    if (count($listPinjamanBuku) < 1) {
        $queryInsertPeminjaman = "INSERT INTO `peminjaman` VALUES (NULL, '$id_buku', '$id_user', '$jumlah_pinjam', current_timestamp())";
        mysqli_query($conn, $queryInsertPeminjaman);
        return mysqli_affected_rows($conn);
    }

    $jumlahPinjamanSaatIni = $listPinjamanBuku[0]["jumlah"] + $jumlah_pinjam;
    $queryUpdatePeminjaman = "UPDATE `peminjaman` SET jumlah = '$jumlahPinjamanSaatIni' WHERE id_user = '$id_user' AND id_buku = '$id_buku'";
    mysqli_query($conn, $queryUpdatePeminjaman);
    return mysqli_affected_rows($conn);
}

function pengembalianBuku($post, $conn) {
    $id_buku        = $post["id_buku"];
    $id_user        = $post["id_user"];
    $jumlah_dikembalikan  = $post["jumlah_dikembalikan"];

    $bookResults = fetchData("SELECT jumlah FROM books WHERE id_buku = '$id_buku'");
    $currentBookCount = $bookResults[0]["jumlah"];

    $jumlahBukuSetelahPengembalian = $currentBookCount + $jumlah_dikembalikan;
    // var_dump($jumlahBukuSetelahPengembalian);
    // exit;
    $queryUpdateBook = "UPDATE `books` SET jumlah = '$jumlahBukuSetelahPengembalian' WHERE id_buku = '$id_buku '";
    mysqli_query($conn, $queryUpdateBook);
    $updatedBooks = mysqli_affected_rows($conn);

    if ($updatedBooks < 1) {
        return "GAGAL_SAAT_MEMPERBARUI_JUMLAH_BUKU";
    }

    $listPinjamanBuku = fetchData("SELECT jumlah FROM peminjaman WHERE id_buku = '$id_buku' AND id_user = '$id_user'");

    $jumlahPinjamanSaatIni = $listPinjamanBuku[0]["jumlah"] - $jumlah_dikembalikan;


    if ($jumlahPinjamanSaatIni < 1) {
        $queryDeletePeminjaman = "DELETE FROM `peminjaman` WHERE id_buku = '$id_buku' AND id_user = '$id_user'";
        mysqli_query($conn, $queryDeletePeminjaman );
        return mysqli_affected_rows($conn);
    }

    $queryUpdatePeminjaman = "UPDATE `peminjaman` SET jumlah = '$jumlahPinjamanSaatIni' WHERE id_user = '$id_user' AND id_buku = '$id_buku'";
    mysqli_query($conn, $queryUpdatePeminjaman);
    return mysqli_affected_rows($conn);
}
?>