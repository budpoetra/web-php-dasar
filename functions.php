<?php

$serverName = "localhost";
$databaseName = "phpdasar";
$username = "root";
$password = "";

// Database connection
$conn = mysqli_connect($serverName, $username, $password, $databaseName);

// Cek koneksi Database
if ( !$conn ) {
   die("Connection Failed:".mysqli_connect_errno()); 
}

function query($query) {
    // Query data
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data) {
    global $conn;

    // Pengambilan data
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);

    // Upload gambar
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }

    // Query insert data
    $insert = "INSERT INTO mahasiswa
                    VALUES
                (NULL, '$nama', '$npm', '$email', '$jurusan', '$gambar')
            ";
    mysqli_query($conn, $insert);

    return mysqli_affected_rows($conn);
}

function delete($nama) {
    global $conn;

    $delete = "DELETE FROM mahasiswa WHERE nama = '$nama'";
    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;

    // Pengambilan data
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $oldGambar = $data["oldGambar"];

    // Cek perubahan gambar
    if ( $_FILES["gambar"]["error"] === 4 ) {
        $gambar = $oldGambar;
        echo "
            <script>
                alert ('Your Photo Back to Old');
            </script>
        ";
    } else {
        $gambar = upload();
        if ( !$gambar ) {
            return false;
        }
    }

    // Query Update data
    $edit = "UPDATE mahasiswa 
                SET 
            nama = '$nama', npm = '$npm', jurusan = '$jurusan', email = '$email', gambar = '$gambar'
                WHERE 
            id = $id; 
            ";
    mysqli_query($conn, $edit);

    return mysqli_affected_rows($conn);
}

function search($keyword) {
    $query = "SELECT * FROM mahasiswa 
                WHERE 
            nama LIKE '%$keyword%' OR 
            npm LIKE '%$keyword%' OR 
            email LIKE '%$keyword%' OR 
            jurusan LIKE '%$keyword%'
            ";

    return query($query);
}

function upload() {
    $nameFile = $_FILES["gambar"]["name"];
    $sizeFile = $_FILES["gambar"]["size"];
    $errorFile = $_FILES["gambar"]["error"];
    $tempFile = $_FILES["gambar"]["tmp_name"];

    // Cek ketersediaan gambar
    if ( $errorFile === 4 ) {
        echo "
            <script>
                alert ('Please Upload Your Photo!');
            </script>
        ";
        return false;
    }

    // Cek ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nameFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "
            <script>
                alert ('Your Uploaded is not a Photo!');
            </script>
        ";
        return false;
    }

    // Cek ukuran gambar
    // 1mb = 1000000
    if ( $sizeFile > 2000000 ) {
        echo "
            <script>
                alert ('The Photo You Uploaded is too Big. Max size is 2mb!');
            </script>
        ";
        return false;
    }

    // Valid Uploaded
    // Generate name gambar
    $nameNewGambar = 'Image-'.uniqid().'.'.$ekstensiGambar;
    move_uploaded_file($tempFile, 'img/'.$nameNewGambar);

    return $nameNewGambar;
}

function registrasi($data) {
    global $conn;
    
    // Query data
    $name = $data["name"];
    $username = strtolower(stripslashes($data["username"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek Kesamaan Username
    $result = mysqli_query($conn, "SELECT username FROM account WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result) ) {
        echo "
            <script>
                alert ('Username is exist');
            </script>
        ";
        return false;
    }
    
    // Pengecekan password
    if ( $password !== $password2 ) {
       echo "
            <script>
                alert ('Passwords do not match');
            </script>
        ";
        return false; 
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = ("INSERT INTO account
                VALUE
            (NULL, '$name', '$username', '$email', '$password')
            ");
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

?>