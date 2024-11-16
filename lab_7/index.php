<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php session_start(); ?>
    <div class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
            <button id="profileBtn">Edit profile</button>
            <button id="logoutBtn">Exit</button>
        <?php else: ?>
            <h1>Welcome!</h1>
            <button id="loginBtn">Log in</button>
            <button id="registerBtn">Register</button>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="main.js"></script>
</body>

</html>