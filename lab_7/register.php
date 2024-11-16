<?php
include 'validation.php';

$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

$validationError = validateForm($username, $email, $password, $confirmPassword);
if ($validationError) {
    pg_close($conn);
    exit();
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$sql = "SELECT * FROM users WHERE email = $1";
$result = pg_query_params($conn, $sql, array($email));

if (pg_num_rows($result) > 0) {
    echo "User with this email exist";
} else {
    $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $sql, array($username, $email, $passwordHash));

    if ($result) {
        echo "success";
    } else {
        echo "Error during registration";
    }
}

pg_close($conn);
