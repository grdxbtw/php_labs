<?php
$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email=$1";
$result = pg_query_params($conn, $sql, array($email));

if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];
        echo "success";
    } else {
        echo "Wrong password";
    }
} else {
    echo "User not found";
}

pg_close($conn);
?>