<?php
session_start();

// Pengecekan Log In
if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$nama = $_GET["nama"];

if ( delete($nama) > 0 ) {
    echo "
            <script>
                alert ('Success to Delete Data');
                document.location.href = 'index.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert ('Failure to Delete Data');
                document.location.href = 'index.php';
            </script>
        ";   
}

?>