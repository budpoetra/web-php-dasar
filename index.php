<?php
require "functions.php";

$mahasiswa = query("SELECT * FROM mahasiswa");
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
                <a href="edit.php">Edit</a>
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