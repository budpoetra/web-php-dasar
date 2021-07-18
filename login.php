<?php
// cek tombol submit
if ( isset($_POST["submit"]) ) {

    // cek validasi username dan password
    if ( $_POST["username"] == "admin" && $_POST["password"] == "admin") {
        // true
        header("Location: index.php");
        exit;
    } else {
        // false
        $error = true;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if (isset($error)) : ?>
<p>Username / Password Salah</p>
<?php endif;?>

<form action="" method="POST">
    <li>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </li>

    <li>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </li>

    <li>
        <button type="submit" name="submit">Login</button>
    </li>
</form>
    
</body>
</html>