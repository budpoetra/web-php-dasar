<?php
session_start();
require 'functions.php';

// Cek COOKIE
if ( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // cek id
    $cekId = mysqli_query($conn, "SELECT username FROM account WHERE id = $id");
    $result = mysqli_fetch_assoc($cekId);

    // cek username
    if ( $key === hash('sha256', $result["username"]) ) {
        $_SESSION["login"] = true;
    }
}

// Cek SESSION
if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

// cek tombol submit
if ( isset($_POST["sign_in"]) ) {
    // Query data
    $username = $_POST["username"];
    $password = $_POST["password"];

    $cekUsername = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");

    // Cek ketersediaan username
    if ( mysqli_num_rows($cekUsername) === 1 ) {
        // Cek password
        $fetch = mysqli_fetch_assoc($cekUsername);
        if ( password_verify($password, $fetch["password"]) ) {
            // Create SESSION
            $_SESSION["login"] = true;

            // Cek COOKIE
            if ( $_POST["remember"] === 'on' ) {
                // Create COOKIE => 1 Jam
                setcookie('id', $fetch["id"], time()+3600);
                setcookie('key', hash('sha256', $fetch["username"]), time()+3600);
            }

            header("Location: index.php");
            exit;
        }
    }
    
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>

<h1>Sign In</h1>

<?php if (isset($error)) : ?>
<p>Username / Password Salah</p>
<?php endif;?>

<form action="" method="POST">
    <table>
        <tr>
            <td><label for="username">Username</label></td>
            <td>:</td>
            <td><input type="text" name="username" id="username"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td>:</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </td>
        </tr>
    </table>
    <button type="submit" name="sign_in">Sign In</button>
</form>

</body>
</html>