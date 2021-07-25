<?php 

require '../../functions.php';

$search = $_GET["search"];

$query = "SELECT * FROM mahasiswa 
            WHERE 
        nama LIKE '%$search%' OR 
        npm LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        jurusan LIKE '%$search%'
        ";
$mahasiswa = query($query);

?>

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
