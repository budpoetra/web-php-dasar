<?php
require 'functions.php';

// Pengecekan tombol submit
if ( isset($_POST["submit"]) ) { 
    // Pengecekan input data
    if ( add($_POST) > 0 ) {
        echo "
            <script>
                alert ('Success to Input Data');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert ('Failure to Input Data');
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
    <title>Add New Data</title>
</head>
<body>

<h1>ADD NEW DATA</h1>
<form action="" method="POST">
    <table>
        <tr>
            <td><label for ="nama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="nama" id="nama" required></td>
            <!-- required = agar inputan tidak kosong -->
        </tr>
        <tr>
            <td><label for ="npm">NPM</label></td>
            <td>:</td>
            <td><input type="text" name="npm" id="npm" required></td>
        </tr>
        <tr>
            <td><label for ="jurusan">Jurusan</label></td>
            <td>:</td>
            <td><input type="text" name="jurusan" id="jurusan" required></td>
        </tr>
        <tr>
            <td><label for ="email">Email</label></td>
            <td>:</td>
            <td><input type="text" name="email" id="email" required></td>
        </tr>
        <tr>
            <td><label for ="gambar">Photo</label></td>
            <td>:</td>
            <td><input type="text" name="gambar" id="gambar" required></td>
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