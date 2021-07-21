<?php 

require 'functions.php';

// Fetch data from URL
$id = $_GET["id"];
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");

// Pengecekan tombol submit
if ( isset($_POST["submit"]) ) { 
    // Pengecekan input data
    if ( edit($_POST) > 0 ) {
        echo "
            <script>
                alert ('Success to Edit Data');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert ('Failure to Edit Data');
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>

<h1>EDIT DATA</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mhs[0]["id"]; ?>">
    <input type="hidden" name="oldGambar" value="<?= $mhs[0]["gambar"]; ?>">
    <table>
        
        <tr>
            <td><label for ="nama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="nama" id="nama" required value="<?= $mhs[0]["nama"]; ?>"></td>
            <!-- required = agar inputan tidak kosong -->
        </tr>
        <tr>
            <td><label for ="npm">NPM</label></td>
            <td>:</td>
            <td><input type="text" name="npm" id="npm" required value="<?= $mhs[0]["npm"]; ?>"></td>
        </tr>
        <tr>
            <td><label for ="jurusan">Jurusan</label></td>
            <td>:</td>
            <td><input type="text" name="jurusan" id="jurusan" required value="<?= $mhs[0]["jurusan"]; ?>"></td>
        </tr>
        <tr>
            <td><label for ="email">Email</label></td>
            <td>:</td>
            <td><input type="text" name="email" id="email" required value="<?= $mhs[0]["email"]; ?>"></td>
        </tr>
        <tr>
            <td><label for ="gambar">Photo</label></td>
            <td>:</td>
        </tr>
        <tr>
            <td>
                <img src="img/<?= $mhs[0]["gambar"]; ?>" width="75">
            </td>
        </tr>
        <tr>
            <td>
                <input type="file" name="gambar" id="gambar">
            </td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">Submit</button></td>
        </tr>
    </table>            
</form>
<br>
<br>
<a href="index.php">Kembali</a>
    
</body>
</html>