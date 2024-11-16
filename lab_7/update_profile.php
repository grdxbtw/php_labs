<?php
include 'validation.php';

session_start();

if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit();
}

$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$validationError = validateForm($username, $email, $password);
if ($validationError) {
    pg_close($conn);
    exit();
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$current_username = $_SESSION['username'];

$sql = "UPDATE users SET username = $1, password = $2 WHERE username = $3";
$result = pg_query_params($conn, $sql, array($username, $passwordHash, $current_username));

if ($result) {
    $_SESSION['username'] = $username;
    echo "success";
} else {
    echo "Error during profile update";
}

pg_close($conn);
