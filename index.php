<?php
session_start();
require "functions.php";

// Pengecekan Log In
if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

// Pagination
// // Konfigurasi
$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
$awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY nama ASC LIMIT $awalData, $jumlahDataPerhalaman");

// Fitur Searching
$keyword = $_POST["keyword"];
if ( isset($_POST["search"]) ) {
    $mahasiswa = search($keyword);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB PHP DASAR</title>
</head>
<body>

<h1>Web PHP Dasar</h1>

<a href="add.php">Add New Data</a>
<br>
<br>

<a href="logout.php">Log Out</a>
<br>
<br>

<!-- Serching -->
<form action="" method="POST">
    <input type="text" name="keyword" placeholder="Searching..." autocomplete="off" autofocus>
    <button type="submit" name="search">Search</button>
</form>
<br>

<!-- Navigasi Page -->
<div class="pagination" style="text-align: center;">
    <?php if ( $halamanAktif > 1 ) : ?>
        <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
        <?php if ( $i == $halamanAktif ) : ?>
            <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ( $halamanAktif < $jumlahHalaman ) : ?>
        <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
</div>
<br>

<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th></th>
        <th>No.</th>
        <th>Photo</th>
        <th>Nama</th>
        <th>NPM</th>
        <th>Jurusan</th>
        <th>Email</th>
    </tr>

    <!-- DATA -->
    <?php $i = 1; ?>
    <?php foreach( $mahasiswa as $mhs ) : ?>
        <tr>
            <td>
                <a href="edit.php?id=<?= $mhs["id"]; ?>">Edit</a>
                |
                <a href="delete.php?nama=<?= $mhs["nama"]; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?');">Delete</a>
            </td>
            <td> <?= $i; ?> </td>
            <td><img src="img/<?= $mhs["gambar"]; ?>" width="50"></td>
            <td><?= $mhs["nama"] ?></td>
            <td><?= $mhs["npm"] ?></td>
            <td><?= $mhs["jurusan"] ?></td>
            <td><?= $mhs["email"] ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>

</table> 

</body>
</html>