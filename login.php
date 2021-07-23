<?php
session_start();

// Cek Login
if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

// cek tombol submit
if ( isset($_POST["sign_in"]) ) {
    if ( login($_POST) ) {
        // Create session
        $_SESSION["login"] = true;

        header("Location: index.php");
    } else {
        $error =  true;
    }
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
    </table>
    <button type="submit" name="sign_in">Sign In</button>
</form>

</body>
</html>