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
    $gambar = $data["gambar"];

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

?>