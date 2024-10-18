<?php
$cookie_name = "name";

if (isset($_POST['delete_cookie'])) {
    setcookie($cookie_name, "", time() - 3600, "/");
    header("Location: process.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    setcookie($cookie_name, $name, time() + (86400 * 7), "/"); // 86400 = 1 day

    header("Location: process.php");
    exit();
}

$greeting = '';
if (isset($_COOKIE['name'])) {
    $greeting = "Привіт, " . htmlspecialchars($_COOKIE['name']) . "!";
}

include 'index.html';
?>