<?php

// Database connection
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

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
    } else {
        $gambar = upload();
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
    global $conn;
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
    $tempFile = $_FILES["gambar"]["temp_name"];

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
    $ekstensiGambarValid = ['jpg', 'jepg', 'png'];
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
    $nameNewGambar = uniqid().'.'.$ekstensiGambar;
    move_uploaded_file($tempFile, 'img/'.$nameNewGambar);

    return $nameFile;
}

?>